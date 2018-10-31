<?php
header('Access-Control-Allow-Origin: *');
		include_once '../../config/Conexao.php';
		include_once '../../models/Categoria.php';

		
		$database = new Conexao();
	//recebe a conexao feita
		$con = $database->getConexao();
		
		$categoria = new Categoria($con);
		if(isset($_GET['id'])){
			$resultado = $categoria->read($_GET['id']);
		}else{
			$resultado = $categoria->read();
		}
		echo(json_encode($resultado));

