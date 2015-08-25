DIM objShell
set objShell=wscript.createObject("wscript.shell")
WScript.Sleep(20000)
iReturn=objShell.Run("cmd.exe /C explorer http://localhost/admin/socket_timing.php", 0, TRUE)