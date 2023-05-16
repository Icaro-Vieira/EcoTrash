<?php

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'ecotrash');

    require_once("PersonalUser.php");
    require_once("BusinessUser.php");
    require_once("Address.php");
    require_once("AddressDAO.php");
    require_once("CollectionPointsDAO.php");

    class UserDAO{

        private $banco;

        public function __construct(){
            $this->banco = new PDO('mysql:host='.HOST.'; dbname='.DB_NAME,USER,PASSWORD);
        }

        public function cadastrar($usuario){

            $inserir = $this->banco->prepare("INSERT INTO cadastro (NOME, DOCUMENTO, EMAIL, TELEFONE, SENHA, ID_ENDERECO, TIPO_CADASTRO, SEGMENTO) VALUES (?,?,?,?,?,?,?,?);");

            $novo_usuario = array($usuario->get_nome(), $usuario->get_documento(), $usuario->get_email(), $usuario->get_telefone(), $usuario->get_senha(), $usuario->get_idEndereco(), $usuario->get_tipoUsuario());

            if($usuario->get_tipoUsuario() == 'F'){
                array_push($novo_usuario, NULL); // Segmento
            }
            else{
                array_push($novo_usuario, $usuario->get_segmento());
            }

            if($inserir->execute($novo_usuario)){
                return true;
            }
            
            return false;
        }

        public function consultar_documento($documento){

            $consulta = $this->banco->prepare('SELECT * FROM cadastro WHERE DOCUMENTO = :documento');
            $consulta->bindParam(':documento', $documento);
            $consulta->execute();

            $usuario = $consulta->fetchObject();

            if (!$usuario) {
                return null;
            }

            // Verifica se o cadastro é de uma pessoa física ou jurídica
            if ($usuario->TIPO_CADASTRO == 'F') {
                $usuario = new PersonalUser($usuario->NOME, $usuario->DOCUMENTO, $usuario->EMAIL, $usuario->TELEFONE, $usuario->ID_ENDERECO, $usuario->SENHA);
            } 
            else {
                $usuario = new BusinessUser($usuario->NOME, $usuario->DOCUMENTO, $usuario->EMAIL, $usuario->TELEFONE, $usuario->ID_ENDERECO, $usuario->SEGMENTO, $usuario->SENHA);
            }

            return $usuario;
        }

        public function login($usuario, $senha){

            if ($usuario != null && password_verify($senha, $usuario->get_senha())){
                return true;
            } 

            return false;
        }

        public function editar_usuario($usuario, $campoDeEdicao){

            //if ($usuario != null && password_verify($senha, $usuario->get_senha())){
              //  return true;
            //} 

            return false;
        }

        public function excluir_usuario($documento){    

            $delete = $this->banco->prepare("DELETE FROM cadastro WHERE DOCUMENTO=?");
            $cadastro = array($documento);

            if($delete->execute($cadastro)){
                return true;
            }
        
            return false;
        }

        public function buscarIdEndereco($documento){    

            $consulta = $this->banco->prepare('SELECT ID_ENDERECO FROM cadastro WHERE DOCUMENTO = :documento');
            $consulta->bindParam(':documento', $documento);
            $consulta->execute();

            $idEndereco = $consulta->fetchObject();

            if (!$idEndereco) {
                return null;
            }
            
            return $idEndereco->ID_ENDERECO;
        }

        public function verificarEnderecoEmOutroCadastro($idEndereco){    

            $query = $this->banco->prepare("SELECT COUNT(*) as count FROM cadastro WHERE ID_ENDERECO = :id_endereco");
            $query->bindParam(":id_endereco", $id_endereco);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

            return ($result['count'] > 1);
        }

        public function verificarDocumento($documento){    

            $query = $this->banco->prepare("SELECT COUNT(*) as count FROM cadastro WHERE DOCUMENTO = :documento");
            $query->bindParam(":documento", $documento);
            $query->execute();
            
            $result = $query->fetch(PDO::FETCH_ASSOC);

            return $result['count'];
        }

        public function verificarEmail($email){    

            $query = $this->banco->prepare("SELECT COUNT(*) as count FROM cadastro WHERE EMAIL = :email");
            $query->bindParam(":email", $email);
            $query->execute();
            
            $result = $query->fetch(PDO::FETCH_ASSOC);

            return $result['count'];
        }
    }

?>