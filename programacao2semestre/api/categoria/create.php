<?php
	header('Content-Type: application/json');

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		require_once '../../config/Conexao.php';
		require_once '../../models/Categoria.php';


		$db= new Conexao();
		$con = $db->getConexao();
		$cat= new Categoria($con);

		$dados = json_decode(file_get_contents('php://input'));
		
		$cat->nome=$dados->nome;
		$cat->descricao=$dados->descricao;
		$cat->create();


	}