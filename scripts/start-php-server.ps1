$ErrorActionPreference = "Stop"

# Caminho do site
$sitePath = "C:\Users\User\Desktop\TRvet\SITE TRVET"

# Parâmetros do servidor embutido do PHP
$phpArgs = "-S 127.0.0.1:8000 -t `"$sitePath`""

# Inicia o servidor PHP em segundo plano, janela oculta
Start-Process -FilePath "php" -ArgumentList $phpArgs -WorkingDirectory $sitePath -WindowStyle Hidden

# Aguarda o servidor responder
$maxWaitSeconds = 10
$ok = $false
for ($i = 0; $i -lt $maxWaitSeconds; $i++) {
  try {
    $resp = Invoke-WebRequest -Uri "http://127.0.0.1:8000/" -UseBasicParsing -TimeoutSec 2
    if ($resp.StatusCode -ge 200 -and $resp.StatusCode -lt 500) { $ok = $true; break }
  } catch {}
  Start-Sleep -Seconds 1
}

if ($ok) {
  Write-Host "PHP server iniciado em http://127.0.0.1:8000/"
} else {
  Write-Warning "Não foi possível validar o servidor em http://127.0.0.1:8000/. Verifique se a porta está livre."
}