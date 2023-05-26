<?php

    define('HOSTPONTO', 'localhost');
    define('USERPONTO', 'root');
    define('PASSWORDPONTO', '');
    define('DB_NAMEPONTO', 'ecotrash3');

    require_once("CollectionPoints.php");

    class CollectionPointsDAO{

        private $banco;

        public function __construct(){
            $this->banco = new PDO('mysql:host='.HOSTPONTO.'; dbname='.DB_NAMEPONTO,USERPONTO,PASSWORDPONTO);
        }

        public function cadastrar($pontoDeColeta){
            
            $inserir = $this->banco->prepare("INSERT INTO pontos_coleta (DESCRICAO, CEP, LOGRADOURO, BAIRRO, NUMERO, TIPOMATERIAIS, ID_CADASTRO) VALUES (?,?,?,?,?,?,?);");

            $novoPonto = array($pontoDeColeta->get_descricao(), $pontoDeColeta->get_cep(), $pontoDeColeta->get_logradouro(), $pontoDeColeta->get_bairro(), $pontoDeColeta->get_numero(), $pontoDeColeta->get_tipoMateriais(), $pontoDeColeta->get_idCadastro());
        
            if($inserir->execute($novoPonto)){
                $id = $this->banco->query("SELECT LAST_INSERT_ID()")->fetchColumn();
        
                $pontoDeColeta->set_id($id);
        
                return true;
            }
                
            return false;
        }

        public function verificarPonto($cep, $numero){
            
            $query = $this->banco->prepare("SELECT COUNT(*) as count FROM pontos_coleta WHERE CEP = :cep AND NUMERO = :numero");
            $query->bindParam(":cep", $cep);
            $query->bindParam(":numero", $numero);

            $query->execute();
            
            $result = $query->fetch(PDO::FETCH_ASSOC);

            return $result['count'];
        }

        public function listaCadastrosPontos($idUsuario){
            $query = $this->banco->prepare("SELECT * FROM solicitacao_ponto WHERE ID_CADASTRO = :idUsuario");
            $query->bindParam(":idUsuario", $idUsuario);
            $query->execute();
            
            $linha = $query->fetchAll(PDO::FETCH_OBJ);
    
            $listaCadastrosPontos = [];
    
            foreach($linha as $ponto){
                $pontoCadastrado = new CollectionPoints($ponto->DESCRICAO, $ponto->CEP, $ponto->LOGRADOURO, $ponto->BAIRRO, $ponto->NUMERO, $ponto->TIPOMATERIAIS,  $ponto->ID_CADASTRO);

                $pontoCadastrado->set_id($ponto->ID);

                array_push($listaCadastrosPontos, $pontoCadastrado);
            }
    
            return $listaCadastrosPontos;
        }
    }

?>