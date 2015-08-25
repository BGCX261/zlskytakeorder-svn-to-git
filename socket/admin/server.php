<?php
dl('php_sockets.dll');
// Server
// 设置错误处理
error_reporting (E_ALL);
// 设置运行时间
set_time_limit (0);
// 起用缓冲
ob_implicit_flush ();
$ip = "192.168.1.2"; // IP地址
$port = 1000; // 端口号

$socket = socket_create (AF_INET, SOCK_STREAM, SOL_TCP); // 创建一个SOCKET
if ($socket)
echo "socket_create() successed!\n";
else
echo "socket_create() failed:".socket_strerror ($socket)."\n";

$bind = socket_bind ($socket, $ip, $port); // 绑定一个SOCKET
if ($bind)
echo "socket_bind() successed!\n";
else
echo "socket_bind() failed:".socket_strerror ($bind)."\n";

$listen = socket_listen ($socket); // 间听SOCKET
if ($listen)
echo "socket_listen() successed!\n";
else
echo "socket_listen() failed:".socket_strerror ($listen)."\n";

while (true)
{
$msg = socket_accept ($socket); // 接受一个SOCKET
while (true)
{
	$command = trim(socket_read ($msg, 1024));
	if ($command==='')break;
	switch ($command)
	{
		case 'SIXZ' :{
			$writer='SS25545O02CCZ';
		}
		default:{
			$writer='SETOK';
		}
	}
	if (preg_match('/SI[\d]{1}Z/',$command)){
		$writer="SS".substr($command,2,1)."5545O02CCZ";
	}
	socket_write ($msg, $writer, strlen ($writer));
}
socket_close ($msg);
}

socket_close ($socket); // 关闭SOCKET
?>
