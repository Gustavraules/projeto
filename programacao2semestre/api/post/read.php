<?php
	header('Access-Control-Allow-Origin: *');
		include_once '../../config/Conexao.php';
		include_once '../../models/Post.php';

		
		$database = new Conexao();
	//recebe a conexao feita
		$con = $database->getConexao();
		
		$pos = new Post($con);
		if(isset($_GET['id'])){
			$resultado = $pos->read($_GET['id']);
		}else{
			$resultado = $pos->read();
		}
		echo(json_encode($resultado));

