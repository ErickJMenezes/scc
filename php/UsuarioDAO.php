<?php

include 'Conexao.php';

/**
*	Classe que representa a tabela de "usuario" do banco de dados.
*	Também pode ser usada para autenticar um usuário pelo login e senha ou criar um novo usuário.
*	
*	@author ErickM
*/
class UsuarioDAO {

	private $id;
	public $nome;
	public $senha;
	public $cargo;
	public $status;
	public $email;
	public $login;
	private $senhaOld;

	/**
	* @param Integer recebe um id de usuário para construir o objeto que representa o usuário.
	*/
	public function __construct($id) {
		$sql = "SELECT * FROM `usuario` WHERE id = :id;";
		$conexao = Conexao::getInstance();

		$stmt = $conexao->prepare($sql);
		$stmt->bindParam(':id', $id);
		$ret = $stmt->execute();

		$usr = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$this->id = $usr[0]['id'];
		$this->nome = $usr[0]['nome'];
		$this->senha = $usr[0]['senha'];
		$this->cargo = $usr[0]['cargo'];
		$this->status = $usr[0]['status'];
		$this->email = $usr[0]['email'];
		$this->login = $usr[0]['login'];
		$this->senhaOld = $this->senha;
	}

	/**
	*	Método para confirmar alterações nos atributos do objeto.
	*/
	public function commit(){
		$conexao = Conexao::getInstance();
		$sql = "UPDATE `usuario` SET nome = :nome, cargo = :cargo, status = :status, email = :email, senha = :senha, login = :login WHERE id = :id";

		$stmt = $conexao->prepare($sql);
		if($this->senha == $this->senhaOld){
			$stmt->bindParam(':senha', $this->senhaOld);
		} else {
			$novasenha = md5($this->senha);
			$stmt->bindParam(':senha', $novasenha);
			$this->senhaOld = md5($this->senha);
		}
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':cargo', $this->cargo);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':login', $this->login);
		$stmt->bindParam(':id', $this->id);
		$return = $stmt->execute();

		if($return){
			return 1;
		} else {
			return -1;
		}
	}

	public function getId(){
		return $this->id;
	}

	/**
	*	Método para criar novos usuários no banco de dados
	*	@return boolean.
	*/
	public static function create($nome, $login, $senha, $email, $status, $cargo){
		$sql = "INSERT INTO `usuario` (nome, login, senha, email, cargo, status) VALUES (:nome, :login, md5(:senha), :email, :cargo, :status);";

		$conexao = Conexao::getInstance();
		$stmt = $conexao->prepare($sql);
		$stmt->bindParam(':nome', $nome);
		$stmt->bindParam(':login', $login);
		$stmt->bindParam(':senha', $senha);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':cargo', $cargo);
		$stmt->bindParam(':status', $status);
		$return = $stmt->execute();

		if($return){
			return 1;
		} else {
			return 0;
		}
	}

	/**
	*	@return UsuarioDAO retorna nova instancia do objeto se usuario existir, caso contrário retorna null
	*	Usagem:
	*		$var = UsuarioDAO::auth(<str1>, <str2>);
	*/
	public static function auth($login, $senha){
		$conexao = Conexao::getInstance();
		$sql = "SELECT id FROM usuario WHERE login = :login AND senha = md5(:senha);";
		$stmt = $conexao->prepare($sql);
		$stmt->bindParam(':login', $login);
		$stmt->bindParam(':senha', $senha);
		$ret = $stmt->execute();
		$usr = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if(count($usr) > 0){
			return new UsuarioDAO($usr[0]['id']);
		} else {
			return null;
		}
	}
}