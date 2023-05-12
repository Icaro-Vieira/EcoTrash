<?php

    define('HOSTENDERECO', 'localhost');
    define('USERNDERECO', 'root');
    define('PASSWORDNDERECO', 'Ec@305três*');
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

            $consulta_Id_endereco = $this->banco->prepare("SELECT ID_ENDERECO FROM cadastro WHERE DOCUMENTO=?");

            if($delete->execute($idEndereco)){
                return true;
            }        
            return false;
            
        }

        /* public function consultar_user_id($id){
            $consulta = $this->banco->prepare("select * from usuario where id=?;");
            $consulta->execute(array($id));

            $linha = $consulta->fetchAll(PDO::FETCH_OBJ);

            foreach($linha as $a){
                $user = new User($a->id, $a->nome, $a->email, $a->senha);
            }

            return $user;
        }

        public function consultar_users(){
            $consulta = $this->banco->prepare("select * from usuario;");
            $consulta->execute();
            
            $linha = $consulta->fetchAll(PDO::FETCH_OBJ);

            $listaUsers = [];

            foreach($linha as $a){
                $user = new User($a->id, $a->nome, $a->email, $a->senha);
                array_push($listaUsers, $user);
            }

            return $listaUsers;
        }

        public function consultar_users_alfabetica(){
            $consulta = $this->banco->prepare("select * from usuario order by nome;");
            $consulta->execute();
            
            $linha = $consulta->fetchAll(PDO::FETCH_OBJ);

            $listaUsersAlfabetica = [];

            foreach($linha as $a){
                $user = new User($a->id, $a->nome, $a->email, $a->senha);
                array_push($listaUsersAlfabetica, $user);
            }

            return $listaUsersAlfabetica;
        }

        public function update_user($nome, $email, $id){

            $editar_user = array($nome,$email,$id);
            $update = $this->banco->prepare("update usuario set nome=?, email=? where id=?");

            if($update->execute($editar_user))
            return true;
            
            return false;
        }

        public function excluir_usuario($id){
            
            $excluir_user = array($id);
            $delete = $this->banco->prepare("delete from usuario where id=?");
        
            if($delete->execute($excluir_user))
            return true;
        
            return false;
        }

        public function login($email, $senha){

            $consultaEmail = $this->banco->prepare("select * from usuario where email=?;");
            $consultaEmail->execute(array($email));

            $linha = $consultaEmail->fetchAll(PDO::FETCH_OBJ);

            if (count($linha) == 0) {
                return false;
            }

            foreach($linha as $a){
                $user = new User($a->id, $a->nome, $a->email, $a->senha);
            }

            if($user->get_password() == $senha)
            return true;
            
            return false;
        } */
    }
?>