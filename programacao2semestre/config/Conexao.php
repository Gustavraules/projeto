<?php
/** classe que cntem os parametors para conexao e o metodo que retorna conexao**/

class Conexao{
	private $host ='localhost';
	private $dbname = 'banco';
	private $user = 'root';
	private $passwd = '';
	//variavel para conexao
	private $conexao;

	public function getConexao(){
		//estabelecer uma conexao e retornar a variavel com a conexao
		$this->conexao = null;
		try{//tenta fazer a conexao
			$this->conexao = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname.';charset=utf8', $this->user,$this->passwd);

		}catch(PDOException $e){
			echo "erro na conexao".$e->getMessage();
		}
		return $this->conexao;
	}


}
$c = new Conexao();
$c->getConexao();