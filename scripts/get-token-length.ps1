$ErrorActionPreference = 'Stop'
$tok = $env:CLOUDFLARE_TOKEN
Write-Output $tok
$len = if ($tok) { $tok.Length } else { 0 }
Write-Output ("Length: " + $len)