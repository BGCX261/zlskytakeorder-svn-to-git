<?php
    //dl("php_sockets.dll");
    $command = $_GET['command'];
    if(isset($command)&& $command != '')
	{
		error_reporting (E_ALL);
		// 设置处理时间
		set_time_limit (0);

		$ip = "192.168.1.253"; // IP 地址
		$port = 1000; // 端口号

		$socket = socket_create (AF_INET, SOCK_STREAM, SOL_TCP); // 创建一个SOCKET
		if ($socket)
		echo "socket_create() successed!\n";
		else
		echo "socket_create() failed:".socket_strerror ($socket)."\n";

		$conn = socket_connect ($socket, $ip, $port); // 建立SOCKET的连接
		if ($conn)
		echo "Success to connection![".$ip.":".$port."]\n";
		else
		echo "socket_connect() failed:".socket_strerror ($conn)."\n";

		//echo socket_read ($socket, 1024);

		


		socket_write ($socket, $command, strlen ($command));

		
		echo "<br>";
		$msg="";
		for ($i=1;$i<3;$i++){
			$msg.= socket_read ($socket, 1); 
		}
		$socket_lenght="";
		switch ($msg){
			case 'SE' :{
				$socket_lenght=5;
				break;
			}
			case 'SF' :{
				$socket_lenght=6;
				break;
			}
			case 'SO' :{
				$socket_lenght=4;
				break;
			}
			default:{
				$socket_lenght=13;
				break;
			}
		}
		for ($i=3;$i<=$socket_lenght;$i++){
			$msg.= socket_read ($socket, 1); 
		}
		
		echo $msg;

		

		//fclose ($stdin);
		socket_close ($socket);
	}
?>
