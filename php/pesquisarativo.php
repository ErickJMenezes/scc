<?php
session_start();
if($_SESSION['auth'] == 'true'){

} else {
    header('Location: ../paginas/index.php');
}

include_once 'lib/AtivoDAO.php';

if(!(AtivoDAO::getIdPeloTombo($_POST['tombopesquisa']) == -1)){

    $ativo = new AtivoDAO(AtivoDAO::getIdPeloTombo($_POST['tombopesquisa']));
    echo json_encode($ativo);
} else {
    echo -1;
}


?>
