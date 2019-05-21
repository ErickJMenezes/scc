<?php
session_start();

if($_SESSION['auth'] == 'true'){

    if(isset($_POST['descricao']) && isset($_POST['usuario_id']) && isset($_POST['chamado_id'])){

        include_once "lib/AcompanhamentoDAO.php";
        include_once 'lib/ChamadoDAO.php';

        $descricao = $_POST['descricao'];
        $uid = $_POST['usuario_id']; //id do usuário
        $cid = $_POST['chamado_id']; // id do chamado

        $status = '';
        if(isset($_POST['status'])){
            $status = 'fechado';
        } else{
          $status = 'ativo';
        }

        $resultado = AcompanhamentoDAO::create($descricao, $cid, $uid);
        if($resultado == 1 && $status == 'ativo'){
            header('Location: ../paginas/analista/acompanhamento.php?id='.$_POST['chamado_id']);
        } else if ($resultado == 1 && $status == 'fechado') {
          $chamado = new ChamadoDAO($cid);
          $chamado->status = 'fechado';
          $chamado->commit();
          header('Location: ../paginas/analista/home.php');
        }


    } else {
        echo '<div class="alert alert-warning" role="alert">Por favor, preencha os campos obrigatórios.</div>';
    }


} else {

    header('Location: ../paginas/index.php');

}
?>
