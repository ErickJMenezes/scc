<?php

include_once 'Conexao.php';
include_once 'UsuarioDAO.php';
include_once 'AtivoDAO.php';

class AcompanhamentoDAO {

  private $id;
  public $descricao;
  public $data_insercao;
  public $chamado_id;
  public $usuario_id;

  public function __construct($id){
    $conexao = Conexao::getInstance();
    $sql = 'SELECT * FROM `acompanhamento` WHERE `id` = :id;';

    $stm = $conexao->prepare($sql);
    $stm->bindParam(':id', $id);
    $stm->execute();

    $ac = $stm->fetchAll(PDO::FETCH_ASSOC);

    $this->id = $ac[0]['id'];
    $this->descricao = $ac[0]['descricao'];
    $this->data_insercao = $ac[0]['data_insercao'];
    $this->chamado_id = $ac[0]['chamado_id'];
    $this->usuario_id = $ac[0]['usuario_id'];
  }

  public function getId(){
    return $this->id;
  }

  public static function create($descricao, $chamado_id, $usuario_id){
    $sql = 'INSERT INTO `acompanhamento` (descricao, chamado_id, usuario_id) VALUES (:des, :chid, :usrid);';
    $con = Conexao::getInstance();

    $stm = $con->prepare($sql);
    $stm->bindParam(':des', $descricao);
    $stm->bindParam(':chid', $chamado_id);
    $stm->bindParam('usrid', $usuario_id);

    $ret = $stm->execute();

    if($ret == 1){
      return $ret;
    } else {
      return -1;
    }

  }

  public static function getAllForChamado($id){
    $con = Conexao::getInstance();
    $stm = $con->prepare('SELECT * FROM `acompanhamento` WHERE chamado_id = :id');
    $stm->bindParam(':id', $id);
    $ret = $stm->execute();

    if($ret == 1){
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    } else {
      return -1;
    }
  }

}
