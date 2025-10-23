$ErrorActionPreference = "Stop"
$startup = Join-Path $env:APPDATA 'Microsoft\Windows\Start Menu\Programs\Startup'
Copy-Item -Path "C:\Users\User\Desktop\TRvet\SITE TRVET\scripts\start-php-server.bat" -Destination $startup -Force
Write-Host "Arquivo colocado em $startup"