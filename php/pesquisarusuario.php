<?php
session_start();
if($_SESSION['auth'] == 'true'){

} else {
    header('Location: ../paginas/index.php');
}
include_once 'lib/UsuarioDAO.php';

$login = $_POST['pesquisa'];

$id = UsuarioDAO::getIdByLogin($login);

if($id == -1){
    echo $id;
} else{

    $usuario = new UsuarioDAO($id);
    $usuario->senha = '';
    echo json_encode($usuario);
}



?>