<?php

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', 'Ec@305três*');
    define('DB_NAME', 'ecotrash');

    require_once("PersonalUser.php");
    require_once("BusinessUser.php");
    require_once("Address.php");
    require_once("AddressDAO.php");
    require_once("PontoDeColetaDAO.php");

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

            $consulta = $this->banco->prepare('SELECT * FROM cadastro WHERE DOCUMENTO = :documento');
            $consulta->bindParam(':documento', $documento);
            $consulta->execute();

            $usuario = $consulta->fetchObject();

            if (!$usuario) {
                return null;
            }

            // Verifica se o cadastro é de uma pessoa física ou jurídica
            if ($usuario->TIPO_CADASTRO == 'F') {
                $usuario = new PersonalUser($usuario->NOME, $usuario->DATA_NASCIMENTO, $usuario->DOCUMENTO, $usuario->EMAIL, $usuario->TELEFONE, $usuario->ID_ENDERECO, $usuario->SENHA);
            } 
            else {
                $usuario = new BusinessUser($usuario->NOME, $usuario->DOCUMENTO, $usuario->EMAIL, $usuario->TELEFONE, $usuario->ID_ENDERECO, $usuario->SEGMENTO, $usuario->SENHA);
            }

            return $usuario;
        }

        public function login($documento, $senha){
            
            $usuario = $this->consultar_documento($documento);

            if ($usuario != null && password_verify($senha, $usuario->get_senha())){
                return true;
            } 
            else {
                return false;
            }
        }

        public function excluir_usuario($documento){    

            $enderecoDAO = new AddressDAO();
            $pontoDeColetaDAO = new PontoDeColetaDAO();

            $cadastro = array($documento);
            $idEndereco = $this->buscarIdEndereco($documento);

            $consultarPontoDeColeta = $pontoDeColetaDAO->consultar_pontoDeColetaPeloID($idEndereco);
            $verificarEndereco = $this->verificarEnderecoEmOutroCadastro($idEndereco);

            $delete = $this->banco->prepare("DELETE FROM cadastro WHERE DOCUMENTO=?");
        
            if(($consultarPontoDeColeta == null) && !$verificarEndereco){
                $excluirEndereco = $enderecoDAO->excluir_endereco($idEndereco);

                if($delete->execute($cadastro))
                    return true;
        
                return false;
            }

            if($delete->execute($cadastro))
                return true;
        
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
    }

?>