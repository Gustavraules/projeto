<?php
/** classe que cntem os parametors para conexao e o metodo que retorna conexao**/

class Categoria{
	public $id;
	public $nome;
	public $descricao;
	private $conexao;

	

	/* ao instanciar um objeto, passaremos a conexao
	a conexao será armazenada em $this->conexao
	para uso aqui na classe*/
	public function __construct($con){
		$this->conexao =$con;
	}
	/*o metodo read() deverá afetuar uma consulta SQL 
	na tabela categproa, e retornar o resultado caso nao seja enviado um id, assume nulç e consulta nromal caso seja enviado faz a consulta com where
	*/
	public function read($id=null){
		if(!isset($id)){
			$consulta = "select * from categoria order by nome";
			$stmt = $this->conexao->prepare($consulta);
		}else{
			$consulta ="select * from categoria where id=:id";
			$stmt = $this->conexao->prepare($consulta);
			$stmt->bindParam('id',$id,PDO::PARAM_INT);
		}
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}
	public function create (){
		$query = 'insert into categoria (nome,descricao) value(:nome,:descricao)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindParam('nome',$this->nome);
		$stmt->bindParam('descricao', $this->descricao);
		if($stmt->execute()){
			return true ;
		}else{
			return false;
		}
	}

	public function update(){
		$query = 'update categoria set (nome = :nome,descricao = :descricao) WHERE id = :id';
		$stmt= $this->conexao->prepare($query);
		$stmt->bindParam('id',$this->id);
		$stmt->bindParam('nome',$this->nome);
		$stmt->bindParam('descricao', $this->descricao);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		}

		public function delete(){
			$query='delete categoria WHERE id = :id';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindParam('id',$this->id);
			if($stmt->execute()){
				return true;
			}else{
				return false;
			}

		}
		
	}
