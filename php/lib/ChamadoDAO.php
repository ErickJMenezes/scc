<?php
session_start();

include 'Conexao.php';
include 'UsuarioDAO.php';
include 'AtivoDAO.php';

class ChamadoDAO {
    
    private $id;
    public $nome;
    public $status;
    public $data_abertura;
    public $requerente;
    public $usuario_atribuido;
    public $ativo_linkado;

    public function __construct($id){
        $conexao = Conexao::getInstance();
        $sql = 'SELECT * FROM `chamado` WHERE `id` = :id;';
        
        $stm = $conexao->prepare($sql);
        $stm->bindParam(':id', $id);
        $stm->execute();
        
        $chamado = $stm->fetchAll(PDO::FETCH_ASSOC);
        
        $this->id = $chamado[0]['id'];
        $this->nome = $chamado[0]['nome'];
        $this->status = $chamado[0]['status'];
        $this->data_abertura = $chamado[0]['data_abertura'];
        $this->requerente = $chamado[0]['requerente'];
        $this->usuario_atribuido = new UsuarioDAO($chamado[0]['usuario_atribuido']);
        $this->ativo_linkado = new AtivoDAO($chamado[0]['ativo_linkado']);
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function commit(){
        $conexao = Conexao::getInstance();
        $sql = 'UPDATE `chamado` SET nome = :nome, status = :status, requerente = :requerente, data_abertura = current_timestamp() WHERE id = :id;';
        
        $stm = $conexao->prepare($sql);
        $stm->bindParam(':nome', $this->nome);
        $stm->bindParam('status', $this->status);
        $stm->bindParam('requerente', $this->requerente);
        
    }
    
    /**
    * Retorna -1 caso dê falha, e 1 caso sucesso.
    */
    public static function create($nome, $status, $requerente, $id_usuario, $tombo_ativo){
        $sql = 'INSERT INTO `chamado` (nome, status, requerente, usuario_atribuido, ativo_linkado) VALUES (:nome, :status, :requerente, :usuario_atribuido, :ativo_linkado);';
        $conexao = Conexao::getInstance();
        $stm = $conexao->prepare($sql);
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':status', $status);
        $stm->bindParam(':requerente', $requerente);
        $stm->bindParam(':usuario_atribuido', $id_usuario);
        $id_ativo = AtivoDAO::getIdPeloTombo($tombo_ativo);
        if($id_ativo == -1){
            return -1;
        }
        $stm->bindParam(':ativo_linkado', $id_ativo);
        $ret = $stm->execute();
        
        if($ret == 1){
            return 1;
        } else {
            return -1;
        }
    }
    
    
    
}