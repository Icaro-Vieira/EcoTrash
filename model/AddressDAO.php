<?php

    define('HOSTENDERECO', 'localhost');
    define('USERNDERECO', 'root');
    define('PASSWORDNDERECO', '');
    define('DB_NAMENDERECO', 'ecotrash');

    require_once("Address.php");

    class AddressDAO{

        private $banco;

        public function __construct(){
            $this->banco = new PDO('mysql:host='.HOSTENDERECO.'; dbname='.DB_NAMENDERECO,USERNDERECO,PASSWORDNDERECO);
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

        public function excluir_endereco($id){    

            $idEndereco = array($id);

            $delete = $this->banco->prepare("DELETE FROM endereco WHERE ID=?");

            if($delete->execute($idEndereco)){
                return true;
            }     

            return false;
        }
    }
    
?>