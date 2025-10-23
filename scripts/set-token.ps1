param([Parameter(Mandatory=$true)][string]$Token)
$ErrorActionPreference = 'Stop'
$env:CLOUDFLARE_TOKEN = $Token
Write-Output "CLOUDFLARE_TOKEN set for current session."