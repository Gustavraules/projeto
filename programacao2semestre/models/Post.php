<?php
/** classe que cntem os parametors para conexao e o metodo que retorna conexao**/

class Post{
	public $id;
	public $titulo;
	public $texto;
	public $id_categoria;
	public $autor;
	public $dt_criacao;
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
			$consulta = "select * from post order by titulo";
			$stmt = $this->conexao->prepare($consulta);
		}else{
			$consulta ="select * from post where id=:id";
			$stmt = $this->conexao->prepare($consulta);
			$stmt->bindParam('id',$id,PDO::PARAM_INT);
		}
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}
	public function create (){
		$query = 'insert into post (titulo,texto,id_cateoria,autor) value(:titulo,:texto,:id_categoria,:autor)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindParam('titulo',$this->titulo);
		$stmt->bindParam('texto', $this->texto);
		$stmt->bindParam('id_categoria', $this->id_categoria);
		$stmt->bindParam('autor', $this->autor);
		if($stmt->execute()){
			return true ;
		}else{
			return false;
		}
	}

	public function update(){
		$query = 'update post set (titulo = :titulo,texto = :texto,id_categoria = :id_categoria,autor = :autor) WHERE id = :id';
		$stmt= $this->conexao->prepare($query);
		$stmt->bindParam('id',$this->id);
		$stmt->bindParam('titulo',$this->titulo);
		$stmt->bindParam('texto', $this->texto);
		$stmt->bindParam('id_categoria', $this->id_categoria);
		$stmt->bindParam('autor', $this->autor);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		}

		public function delete(){
			$query='delete post WHERE id = :id';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindParam('id',$this->id);
			if($stmt->execute()){
				return true;
			}else{
				return false;
			}

		}
		
	}
