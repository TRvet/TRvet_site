Param(
  [string]$ZoneName = "trvet.com.br",
  [ValidateSet('flexible','full','strict')]
  [string]$SslMode = "flexible",
  [string]$TunnelCname = "5cb52839-a167-4ae4-a54b-ef0118d9c9ae.cfargotunnel.com"
)

$ErrorActionPreference = "Stop"

function Get-Token {
  $tokenFile = Join-Path (Join-Path $PSScriptRoot "..\cloudflared") "CLOUDFLARE_TOKEN.txt"
  if (Test-Path $tokenFile) {
    (Get-Content $tokenFile -Raw).Trim()
  } elseif ($env:CLOUDFLARE_TOKEN) {
    $env:CLOUDFLARE_TOKEN.Trim()
  } else {
    throw "Token não encontrado. Crie 'cloudflared\\CLOUDFLARE_TOKEN.txt' com o token ou defina CLOUDFLARE_TOKEN no ambiente."
  }
}

function Invoke-CF($Method, $Uri, $Body) {
  $headers = @{ Authorization = "Bearer $Global:CFToken" }
  if ($Body) {
    return Invoke-RestMethod -Method $Method -Uri $Uri -Headers $headers -ContentType 'application/json' -Body ($Body | ConvertTo-Json -Depth 6)
  } else {
    return Invoke-RestMethod -Method $Method -Uri $Uri -Headers $headers
  }
}

function Get-ZoneId($name) {
  $resp = Invoke-CF GET "https://api.cloudflare.com/client/v4/zones?name=$name" $null
  if (-not $resp.success -or $resp.result.Count -eq 0) { throw "Zona '$name' não encontrada." }
  $resp.result[0].id
}

function Set-SSLMode($zoneId, $mode) {
  Write-Host "Ajustando SSL/TLS para '$mode'..."
  $body = @{ value = $mode }
  $resp = Invoke-CF PATCH "https://api.cloudflare.com/client/v4/zones/$zoneId/settings/ssl" $body
  if (-not $resp.success) { throw "Falha ao ajustar SSL: $($resp.errors | ConvertTo-Json -Depth 4)" }
}

function Get-WorkerRoutes($zoneId) {
  $resp = Invoke-CF GET "https://api.cloudflare.com/client/v4/zones/$zoneId/workers/routes" $null
  if (-not $resp.success) { throw "Falha ao listar rotas de Workers: $($resp.errors | ConvertTo-Json -Depth 4)" }
  $resp.result
}

function Remove-WorkerRoutesForHostnames($zoneId, $hostnames) {
  $routes = Get-WorkerRoutes $zoneId
  $toDelete = @()
  foreach ($r in $routes) {
    foreach ($h in $hostnames) {
      if ($r.pattern -like "$h*") { $toDelete += $r }
      if ($r.pattern -like "$h/*") { $toDelete += $r }
      if ($r.pattern -like "*.$h/*") { $toDelete += $r }
    }
  }
  $uniq = $toDelete | Sort-Object id -Unique
  foreach ($r in $uniq) {
    Write-Host "Removendo rota de Worker: $($r.pattern)" -ForegroundColor Yellow
    $resp = Invoke-CF DELETE "https://api.cloudflare.com/client/v4/zones/$zoneId/workers/routes/$($r.id)" $null
    if (-not $resp.success) { throw "Falha ao remover rota '$($r.pattern)': $($resp.errors | ConvertTo-Json -Depth 4)" }
  }
}

function Ensure-Cname($zoneId, $name, $content, $proxied=$true) {
  $q = "https://api.cloudflare.com/client/v4/zones/$zoneId/dns_records?type=CNAME&name=$name"
  $resp = Invoke-CF GET $q $null
  if (-not $resp.success) { throw "Falha ao consultar DNS '$name'" }
  if ($resp.result.Count -gt 0) {
    $rec = $resp.result[0]
    if ($rec.content -ne $content -or $rec.proxied -ne $proxied) {
      Write-Host "Atualizando CNAME $name → $content (proxied=$proxied)" -ForegroundColor Cyan
      $body = @{ type='CNAME'; name=$name; content=$content; proxied=$proxied; ttl=1 }
      $upd = Invoke-CF PUT "https://api.cloudflare.com/client/v4/zones/$zoneId/dns_records/$($rec.id)" $body
      if (-not $upd.success) { throw "Falha ao atualizar DNS '$name'" }
    } else {
      Write-Host "CNAME $name já está correto." -ForegroundColor Green
    }
  } else {
    Write-Host "Criando CNAME $name → $content (proxied=$proxied)" -ForegroundColor Cyan
    $body = @{ type='CNAME'; name=$name; content=$content; proxied=$proxied; ttl=1 }
    $crt = Invoke-CF POST "https://api.cloudflare.com/client/v4/zones/$zoneId/dns_records" $body
    if (-not $crt.success) { throw "Falha ao criar DNS '$name'" }
  }
}

function Ensure-ApexRedirect($zoneId, $apex, $targetUrl) {
  # Tenta usar Rulesets (http_request_dynamic_redirect)
  Write-Host "Configurando Redirect do apex '$apex' → '$targetUrl' via Rulesets..." -ForegroundColor Cyan
  $rs = Invoke-CF GET "https://api.cloudflare.com/client/v4/zones/$zoneId/rulesets/phases/http_request_dynamic_redirect/entrypoint" $null
  if (-not $rs.success) { throw "Falha ao obter ruleset de redirect" }
  $ruleset = $rs.result
  $rules = @()
  if ($ruleset.rules) { $rules = @($ruleset.rules) }
  $existing = $rules | Where-Object { $_.description -eq 'TRvet apex -> www' }
  $ruleBody = @{ 
    description = 'TRvet apex -> www';
    expression = "(http.host eq '$apex')";
    action = 'redirect';
    action_parameters = @{ status_code = 301; url = $targetUrl }
  }
  if ($existing) {
    Write-Host "Atualizando regra existente de redirect..." -ForegroundColor Yellow
    $existing[0].expression = $ruleBody.expression
    $existing[0].action = 'redirect'
    $existing[0].action_parameters = $ruleBody.action_parameters
  } else {
    Write-Host "Inserindo nova regra de redirect do apex..." -ForegroundColor Yellow
    $rules += $ruleBody
  }
  $updateBody = @{ rules = $rules }
  $upd = Invoke-CF PATCH "https://api.cloudflare.com/client/v4/zones/$zoneId/rulesets/$($ruleset.id)" $updateBody
  if (-not $upd.success) { throw "Falha ao aplicar redirect rule: $($upd.errors | ConvertTo-Json -Depth 4)" }
}

# Execução
$Global:CFToken = Get-Token
$zoneId = Get-ZoneId $ZoneName
Write-Host "Zona '$ZoneName' → ID: $zoneId" -ForegroundColor Green

Set-SSLMode $zoneId $SslMode
Remove-WorkerRoutesForHostnames $zoneId @('www.trvet.com.br','tunnel.trvet.com.br','cf-test.trvet.com.br','trvet.com.br')

Ensure-Cname $zoneId 'www.trvet.com.br' $TunnelCname $true
Ensure-Cname $zoneId 'tunnel.trvet.com.br' $TunnelCname $true
Ensure-Cname $zoneId 'cf-test.trvet.com.br' $TunnelCname $true

Ensure-ApexRedirect $zoneId 'trvet.com.br' 'https://www.trvet.com.br/'

Write-Host "Concluído. Valide com:" -ForegroundColor Green
Write-Host "  nslookup www.trvet.com.br" -ForegroundColor Gray
Write-Host "  curl.exe -I https://www.trvet.com.br/" -ForegroundColor Gray