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

        public function cadastrar($pontoDeColeta){
            
            $inserir = $this->banco->prepare("INSERT INTO pontos_coleta (DESCRICAO, CNPJ, LATITUDE, LONGITUDE, ID_ENDERECO) VALUES (?,?,?,?,?);");

            $novoPonto = array($pontoDeColeta->get_descricao(), $pontoDeColeta->get_documento(), $pontoDeColeta->get_latitude(), $pontoDeColeta->get_longitude(), $pontoDeColeta->idEndereco());
        
            if($inserir->execute($novoPonto)){
                $id = $this->banco->query("SELECT LAST_INSERT_ID()")->fetchColumn();
        
                $pontoDeColeta->set_id($id);
        
                return true;
            }
                
            return false;
        }
    }

?>