$ErrorActionPreference = 'Stop'
$tokenPath = Join-Path (Split-Path $PSScriptRoot -Parent) 'cloudflared/CLOUDFLARE_TOKEN.txt'
$tok = $env:CLOUDFLARE_TOKEN
if (-not $tok -or $tok.Trim().Length -eq 0) {
  $tok = Get-Content -Raw $tokenPath
}
$headers = @{ Authorization = "Bearer $tok" }
Invoke-RestMethod -Uri 'https://api.cloudflare.com/client/v4/user/tokens/verify' -Headers $headers | ConvertTo-Json -Depth 4