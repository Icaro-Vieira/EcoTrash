<?php

    define('HOSTPONTORequest', 'localhost');
    define('USERPONTORequest', 'root');
    define('PASSWORDPONTORequest', '');
    define('DB_NAMEPONTORequest', 'ecotrash3');

    require_once("CollectionPoints.php");

    class PointRequestDAO{

        private $banco;

        public function __construct(){
            $this->banco = new PDO('mysql:host='.HOSTPONTORequest.'; dbname='.DB_NAMEPONTORequest,USERPONTORequest,PASSWORDPONTORequest);
        }

        public function cadastrar($solicitacaoPonto){
            
            $inserir = $this->banco->prepare("INSERT INTO solicitacao_ponto (DESCRICAO, CEP, LOGRADOURO, BAIRRO, NUMERO, TIPOMATERIAIS, ID_CADASTRO) VALUES (?,?,?,?,?,?,?);");

            $novoPonto = array($solicitacaoPonto->get_descricao(), $solicitacaoPonto->get_cep(), $solicitacaoPonto->get_logradouro(), $solicitacaoPonto->get_bairro(), $solicitacaoPonto->get_numero(), $solicitacaoPonto->get_tipoMateriais(), $solicitacaoPonto->get_idCadastro());
        
            if($inserir->execute($novoPonto)){
                $id = $this->banco->query("SELECT LAST_INSERT_ID()")->fetchColumn();
        
                $solicitacaoPonto->set_id($id);
        
                return true;
            }
                
            return false;
        }

        public function excluir_solicitacao($idSolicitacao){    

            $delete = $this->banco->prepare("DELETE FROM solicitacao_ponto WHERE ID = :idSolicitacao");
            $delete->bindParam(':idSolicitacao', $idSolicitacao);
            
            if($delete->execute()){
                return true;
            }
        
            return false;
        }

        public function consultarSolicitacao($idSolicitacao){

            $consulta = $this->banco->prepare('SELECT * FROM solicitacao_ponto WHERE ID = :idSolicitacao');
            $consulta->bindParam(':idSolicitacao', $idSolicitacao);
            $consulta->execute();

            $solicitacao = $consulta->fetchObject();
            
            if (!$solicitacao){
                return false;
            }

            $solicitacaoConsultada = new CollectionPoints($solicitacao->DESCRICAO, $solicitacao->CEP, $solicitacao->LOGRADOURO, $solicitacao->BAIRRO, $solicitacao->NUMERO, $solicitacao->TIPOMATERIAIS,  $solicitacao->ID_CADASTRO);

            $solicitacaoConsultada->set_id($solicitacao->ID);

            return $solicitacaoConsultada;
        }

        public function listaSolicitacoes(){
            $consulta = $this->banco->prepare("SELECT * FROM solicitacao_ponto;");
            $consulta->execute();
            
            $linha = $consulta->fetchAll(PDO::FETCH_OBJ);
    
            $listaSolicitacoes = [];
    
            foreach($linha as $solicitacao){
                $s = new CollectionPoints($solicitacao->DESCRICAO, $solicitacao->CEP, $solicitacao->LOGRADOURO, $solicitacao->BAIRRO, $solicitacao->NUMERO, $solicitacao->TIPOMATERIAIS,  $solicitacao->ID_CADASTRO);

                $s->set_id($solicitacao->ID);

                array_push($listaSolicitacoes, $s);
            }
    
            return $listaSolicitacoes;
        }
    }

?>