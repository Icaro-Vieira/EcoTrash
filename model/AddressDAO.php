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

        public function editar_endereco($idEndereco, $logradouro, $numero, $complemento, $bairro, $cidade, $estado, $cep){

            $update = $this->banco->prepare("UPDATE endereco SET LOGRADOURO=?, NUMERO=?, COMPLEMENTO=?, BAIRRO=?, CIDADE=?, ESTADO=?, CEP=? WHERE ID=?");
            $editar_endereco = array($logradouro, $numero, $complemento, $bairro, $cidade, $estado, $cep, $idEndereco);

            if($update->execute($editar_endereco)){
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

        public function consultarEndereco($idEndereco){

            $consulta = $this->banco->prepare('SELECT * FROM endereco WHERE ID = :idEndereco');
            $consulta->bindParam(':idEndereco', $idEndereco);
            $consulta->execute();

            $endereco = $consulta->fetchObject();
            
            if (!$endereco){
                return null;
            }

            $enderecoConsultado = new Address($endereco->LOGRADOURO, $endereco->NUMERO, $endereco->COMPLEMENTO, $endereco->BAIRRO, $endereco->CIDADE, $endereco->ESTADO,  $endereco->CEP);

            $enderecoConsultado->set_id($endereco->ID);

            return $enderecoConsultado;
        }
    }
    
?>