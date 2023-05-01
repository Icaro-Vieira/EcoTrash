<?php

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', 'Ec@305três*');
    define('DB_NAME', 'ecotrash');

    require_once("CadastroPF.php");
    require_once("CadastroPJ.php");

    class CadastroDAO{

        private $banco;

        public function __construct(){
            $this->banco = new PDO('mysql:host='.HOST.'; dbname='.DB_NAME,USER,PASSWORD);
        }

        public function cadastrar($cadastro){

            $inserir = $this->banco->prepare("INSERT INTO cadastro (NOME, DOCUMENTO, EMAIL, TELEFONE, SENHA, ID_ENDERECO, TIPO_CADASTRO, SEGMENTO, DATA_NASCIMENTO) VALUES (?,?,?,?,?,?,?,?,?);");

            $novo_cadastro = array($cadastro->get_nome(), $cadastro->get_documento(), $cadastro->get_email(), $cadastro->get_telefone(), $cadastro->get_senha(), $cadastro->get_idEndereco(), $cadastro->get_tipoCadastro());

            if($cadastro->get_tipoCadastro() == 'F'){
                array_push($novo_cadastro, NULL); // Segmento
                array_push($novo_cadastro, $cadastro->get_dataNascimento());
            }
            else{
                array_push($novo_cadastro, $cadastro->get_segmento());
                array_push($novo_cadastro, NULL); // Data de nascimento
            }

            if($inserir->execute($novo_cadastro)){
                return true;
            }
            else{
                return false;
            }            
        }

        public function consultar_documento($documento){

            $consulta = $this->banco->prepare("SELECT * FROM cadastro WHERE DOCUMENTO=?;");
            $consulta->execute(array($documento));

            $linha = $consulta->fetchAll(PDO::FETCH_OBJ);

            if (count($linha) == 0) {
                return false;
            }

            foreach($linha as $cadastro){
                if($cadastro->get_tipoCadastro() == 'F'){
                    $usuario = new CadastroPF($cadastro->nome, $cadastro->dataNascimento, $cadastro->documento, $cadastro->email, $cadastro->telefone, $cadastro->idEndereco, $cadastro->senha);
                }
                else{
                    $usuario = new CadastroPJ($cadastro->nome, $cadastro->documento, $cadastro->email, $cadastro->telefone, $cadastro->idEndereco, $cadastro->segmento, $cadastro->senha);
                }
            }

            return $usuario;
        }

        public function login($documento, $senha){

            $usuario = $this->consultar_documento($documento);

            if($usuario == false){
                return "nao existe";
            }

            if(password_verify($senha, $usuario->get_senha())){
                return true;
            }  
                     
            return "erro";
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
        }*/
    }
?>