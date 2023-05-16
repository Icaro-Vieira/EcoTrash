<?php

    define('HOSTPONTO', 'localhost');
    define('USERPONTO', 'root');
    define('PASSWORDPONTO', '');
    define('DB_NAMEPONTO', 'ecotrash');

    require_once("CollectionPoints.php");

    class CollectionPointsDAO{

        private $banco;

        public function __construct(){
            $this->banco = new PDO('mysql:host='.HOSTPONTO.'; dbname='.DB_NAMEPONTO,USERPONTO,PASSWORDPONTO);
        }

        public function cadastrar($endereco){
            
            $inserir = $this->banco->prepare("INSERT INTO endereco (LOGRADOURO, NUMERO, COMPLEMENTO, BAIRRO, CIDADE, ESTADO, CEP) VALUES (?,?,?,?,?,?,?);");

            $novoEndereco = array($endereco->get_logradouro(), $endereco->get_numero(), $endereco->get_complemento(), $endereco->get_bairro(), $endereco->get_cidade(), $endereco->get_estado(), $endereco->get_cep());
        
            if($inserir->execute($novoEndereco)){
                $id = $this->banco->query("SELECT LAST_INSERT_ID()")->fetchColumn();
        
                $endereco->set_id($id);
        
                return true;
            }
                
            return false;
        }

        public function consultar_pontoDeColetaPeloID($idEndereco){

            $consulta = $this->banco->prepare('SELECT * FROM pontos_coleta WHERE ID_ENDERECO = :idEndereco');
            $consulta->bindParam(':idEndereco', $idEndereco);
            $consulta->execute();

            $pontoDeColeta = $consulta->fetchObject();
            
            if (!$pontoDeColeta){
                return null;
            }

            $pontoDeColeta = new CollectionPoints($pontoDeColeta->DESCRICAO, $pontoDeColeta->CNPJ, $pontoDeColeta->LATITUDE, $pontoDeColeta->LONGITUDE, $pontoDeColeta->ID_ENDERECO);

            return $pontoDeColeta;
        }
    }

?>