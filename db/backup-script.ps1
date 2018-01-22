# Script modificado
# Autor: Cristian Castro Del Carpio - facebook.com/xtiancastro7
# Fecha: 2015-05-05
# Fuente: SolidShellSecurity.com
################################################
$d = Get-Date
$dString = $d.Year.ToString() + "-" + $d.Month.ToString() + "-" + $d.Day.ToString() + "_" + $d.Hour.ToString() + "-" + $d.Minute.ToString() + "-" + $d.Second.ToString()
$backupFilePath = "D:\backups\dboroblanco_" + $dString + ".sql"
Set-Location -Path D:\ProgramFiles\xampp\mysql\bin
$cmd = "mysqldump.exe -u root --databases dboroblanco > " + $backupFilePath
Write-Host $cmd
Invoke-Expression $cmd | out-null