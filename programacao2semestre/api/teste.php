<?php

	$login = "rafael";
	$senha = 'x" or "1"="1';

	$sql = 'select * from users where login="'.$login.'" and senha="'.$senha.'"';

	print($sql);
