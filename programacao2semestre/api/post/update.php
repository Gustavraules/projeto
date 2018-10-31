<?php
	header('content-type:application/json');
	if ($_SERVER['REQUEST_METHOD'] == 'PUT'){

		require_once '../../config/Conexao.php';
		require_once '../../models/Post.php';

		$dados = json_decode(file_get_contents('php://input'));
	
		$db = new Conexao();
		$conexao = $db->getConexao();

		$pos = new Post($conexao);

		$pos-> id = $dados->id;
		$pos-> titulo = $dados->titulo;
		$pos-> texto = $dados->texto;
		$pos-> id_categoria = $dados->id_categoria;
		$pos-> autor = $dados->autor;

		if($pos->update()){
			$dados= ['mensagem' =>'Post alterada'];

		}else{
			$dados= ['mensagem' =>'Post não criada' .$e->getMessage()];
		}
		echo json_encode($dados);
	}else{
		echo json_encode(['mensagem' =>'Metodo nao suportado'])
	}

	}

