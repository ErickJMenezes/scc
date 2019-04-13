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
			$_SESSION['autenticado'] = true;
			$_SESSION['user_id'] = $user->getId(); 
		} else {
			echo "Usuário desativado";
		}
	} else {
		echo "Usuário não existe";
	}
} else {
	header("Location: ../Paginas/index.html");
}


