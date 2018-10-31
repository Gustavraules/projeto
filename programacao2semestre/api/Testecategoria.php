<?php
//as classess que vou usar
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once '../../config/Conexao.php';
	include_once '../../models/Categoria.php';

//instanciar o objeto conexao
	$database =new Conexao();
//recebe a conexao feita
	$con = $database->getConexao();
	
	$categoria = new Categoria($con);

	$resultado = $categoria->read();

	$qtde_cats = $resultado-> rowCount();

	if($qtde_cats>0){
		$arr_categorias = array();
		$arr_categorias['data'] = array();
	
		while ($row = $resultado-> fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$item = array(
				'id'=>$id,
				'nome'=>$nome,
				'descricao'=>$descricao
			);
			array_push($arr_categorias['data'],$item);
		}
		echo json_encode($arr_categorias);
	}else{
		echo json_encode(
			array('mensagem' =>'nenhuma categoria encontrada')
		);
	}

	}



//instancia o objeto categoria
//passa a conexao
$cat= new Categoria($conexao);

//invoca o metodo read
$resultado = $cat->read();


print_r($resultado);