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

            $inserir = $this->banco->prepare("INSERT INTO cadastro (NOME, DOCUMENTO, EMAIL, TELEFONE, SENHA, ID_ENDERECO, TIPO_CADASTRO, SEGMENTO, SOBRENOME) VALUES (?,?,?,?,?,?,?,?,?);");

            $novo_usuario = array($usuario->get_nome(), $usuario->get_documento(), $usuario->get_email(), $usuario->get_telefone(), $usuario->get_senha(), $usuario->get_idEndereco(), $usuario->get_tipoUsuario());

            if($usuario->juridico()){
                array_push($novo_usuario, $usuario->get_segmento());
                array_push($novo_usuario, NULL); // Sobrenome
            }
            else{
                array_push($novo_usuario, NULL); // Segmento
                array_push($novo_usuario, $usuario->get_sobrenome());
            }

            if($inserir->execute($novo_usuario)){
                return true;
            }
            
            return false;
        }

        public function editar_usuario($documento, $nome, $sobrenome, $email, $telefone, $senha){

            $update = $this->banco->prepare("UPDATE cadastro SET NOME=?, SOBRENOME=?, EMAIL=?, TELEFONE =?, SENHA=? WHERE DOCUMENTO=?");
            $editar_usuario = array($nome, $sobrenome, $email, $telefone, $senha, $documento);

            if($update->execute($editar_usuario)){
                return true;
            }
            
            return false;
        }

        // Função irá retornar todas as informações do usuário com base em seu documento (CFP / CNPJ)
        public function consultar_documento($documento){

            $consulta = $this->banco->prepare('SELECT * FROM cadastro WHERE DOCUMENTO = :documento');
            $consulta->bindParam(':documento', $documento);
            $consulta->execute();

            $usuario = $consulta->fetchObject();

            if (!$usuario) {
                return null;
            }

            // Verifica se o cadastro é de uma pessoa física ou jurídica, assim será criado um usuário para retornar da busca
            if ($usuario->TIPO_CADASTRO == 'F') {
                $usuarioConsultado = new PersonalUser($usuario->NOME, $usuario->SOBRENOME, $usuario->DOCUMENTO, $usuario->EMAIL, $usuario->TELEFONE, $usuario->ID_ENDERECO, $usuario->SENHA);

                $usuarioConsultado->set_id($usuario->ID);
            } 
            else {
                $usuarioConsultado = new BusinessUser($usuario->NOME, $usuario->DOCUMENTO, $usuario->EMAIL, $usuario->TELEFONE, $usuario->ID_ENDERECO, $usuario->SEGMENTO, $usuario->SENHA);

                $usuarioConsultado->set_id($usuario->ID);
            }

            return $usuarioConsultado;
        }

        public function login($usuario, $senha){

            if ($usuario != null && password_verify($senha, $usuario->get_senha())){
                return true;
            } 

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