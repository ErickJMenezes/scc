<?php
include 'UsuarioDAO.php';

/*Autenticação de login*/

if(isset($_POST['usuario']) && isset($_POST['senha'])){
	$login = $_POST['usuario'];
	$senha = $_POST['senha'];
	
	$user = UsuarioDAO::auth($login, $senha);

	if(!is_null($user)){
		if($user->status == 'ativo'){
			echo "logado ";
			echo $user->nome;
			session_start();
			$_SESSION['auth'] = 'true';
			$_SESSION['id'] = $user->getId();
			if($user->login == "admin"){
				header("Location: ../paginas/admin/home.php");
			} else {
				header("Location: ../paginas/analista/home.php");
			}
		} else {
			echo "Usuário desativado";
		}
	} else {
		echo "Usuário não existe";
	}
} else {
	header("Location: ../paginas/index.html");
}


