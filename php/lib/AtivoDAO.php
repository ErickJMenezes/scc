<?php

include_once 'Conexao.php';

class AtivoDAO {

    private $id;
    public $nome;
    public $descricao;
    public $tombo;
    public $status;

    public function __construct($id){
        $sql = 'SELECT * FROM `ativo` WHERE id = :id;';
        $conexao = Conexao::getInstance();

        $stm = $conexao->prepare($sql);
        $stm->bindParam(':id', $id);
        $ret = $stm->execute();

        $usr = $stm->fetchAll(PDO::FETCH_ASSOC);
        $this->id = $usr[0]['id'];
        $this->nome = $usr[0]['nome'];
        $this->descricao = $usr[0]['descricao'];
        $this->tombo = $usr[0]['tombo'];
        $this->status = $usr[0]['status'];
    }

    public function getId(){
        return $this->id;
    }

    public function commit(){
        $sql = 'UPDATE `ativo` SET nome = :nome, descricao = :descricao, tombo = :tombo, status = :status WHERE id = :id;';
        $conexao = Conexao::getInstance();
        $stm = $conexao->prepare($sql);
        $stm->bindParam(':nome', $this->nome);
        $stm->bindParam(':descricao', $this->descricao);
        $stm->bindParam(':tombo', $this->tombo);
        $stm->bindParam(':status', $this->status);

        $ret = $stm->execute();

        if($ret == 1){
            return 1;
        } else {
            return -1;
        }
    }

    public static function create($nome, $descricao, $tombo, $status){
        $sql = "INSERT INTO `ativo` (nome, descricao, tombo, status) values (:nome, :descricao, :tombo, :status);";
        $conexao = Conexao::getInstance();

        $stm = $conexao->prepare($sql);
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':descricao', $descricao);
        $stm->bindParam(':tombo', $tombo);
        $stm->bindParam(':status', $status);
        $ret = $stm->execute();
        if($ret == 1){
            return 1;
        } else {
            return $ret;
        }
    }

    public static function getIdPeloTombo($tombo){
        $sql = 'SELECT `id` FROM `ativo` WHERE tombo = :tombo;';
        $conexao = Conexao::getInstance();
        $stm = $conexao->prepare($sql);
        $stm->bindParam(':tombo', $tombo);
        $ret = $stm->execute();
        if($ret == 1){
            $ativo = $stm->fetchAll(PDO::FETCH_ASSOC);
            if(sizeof($ativo)>0){
                return $ativo[0]['id'];
            } else {
              return -1;
            }
        } else {
            return -1;
        }
    }

    public static function getAtivoPeloTombo($tombo){

        $ret = AtivoDAO::getIdPeloTombo($tombo);

        if($ret != -1){
            return new AtivoDAO($ret);
        } else {
            return -1;
        }
    }



}
