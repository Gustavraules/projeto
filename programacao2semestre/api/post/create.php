<?php
	header('Content-Type: application/json');

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		require_once '../../config/Conexao.php';
		require_once '../../models/post.php';


		$db= new Conexao();
		$con = $db->getConexao();
		$pos= new post($con);

		$dados = json_decode(file_get_contents('php://input'));
		
		$pos->titulo=$dados->titulo;
		$pos->texto=$dados->texto;
		$pos->id_categoria=$dados->id_categoria;
		$pos->autor=$dados->autor;
		$pos->create();


	}