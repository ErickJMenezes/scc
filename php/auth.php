<?php
session_start();
include 'UsuarioDAO.php';

/*Autenticação de login*/

if(isset($_POST['usuario']) && isset($_POST['senha'])){
	$login = $_POST['usuario'];
	$senha = $_POST['senha'];
	
	$user = UsuarioDAO::auth($login, $senha);

	if(!is_null($user)){
		if($user->status == 'ativo'){
			$_SESSION['auth'] = 'true';
			$_SESSION['id'] = $user->getId();
			if($user->cargo == "administrador"){
				header("Location: ../paginas/admin/home.php");
			} else if($user->cargo == 'analista'){
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


