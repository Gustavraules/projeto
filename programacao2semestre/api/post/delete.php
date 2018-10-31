<?php
	header('Content-Type: application/json');
	//verifica se foram preenchidos os dados de autenticação
	if(!isset($_SERVER['PHP_AUTH_USER'])){
		//modifica o header, informando o tipo de autenticação
		header('WWW-Authenticate: Basic realm="Página restrita"');
		//modifica o header,indicando o codigo de nao autorizado
		header('HTTP/1.0 401 Unauthorized');
		//exibe mensagem de erro em json
		echo json_encode(["mensagem"=>"Authenticacao necessaria"]);
		//para a execuçao do script
		exit;
		//se foram preenchidos, testa os valores (neste caso,admin admin)
	}elseif (!($_SERVER['PHP_AUTH_USER']=='admin' &&
		$_SERVER['PHP_AUTH_PW'] == 'admin')){
		header('HTTP/1.0 401 Unauthorized');

		echo json_encode(["mensagem" => "dados incorretos"])
		
	}else{

	if($_SERVER['REQUEST_METHOD'] == 'DELETE'){

		require_once '../../config/Conexao.php';
		require_once '../../models/Post.php';

		$dados = json_decode(file_get_contents('php://input'));

		$db = new Conexao();
		$conexao = $db->getConexao();

		$pos = new Post($conexao);

		$pos->id = $dados->id;

		if($pos->delete()){
			$dados = ['mensagem' => 'Post excluida'];

		}else{
			$dados = ['mensagem' => 'Post nao excluida'];

		}
		echo json_encode($dados);
	}else{
		echo json_encode(['mensagem' => 'metodo nao suportado']);
	}
	}
	