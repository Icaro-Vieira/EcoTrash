<?php

    require_once("../model/BusinessUser.php");
    require_once("../model/UserDAO.php");
    require_once("../model/Address.php");
    require_once("../model/AddressDAO.php");

    //Informações da PJ
    $nome = $_POST['nome-empresa']; 
    $documento = $_POST['cnpj']; 
    $email = $_POST['email']; 
    $telefone = $_POST['telefone']; 
    $segmento = $_POST['segmento-empresa']; 
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); //Função utilizada para gerar um hash seguro. A senha é recebida junto ao algoritmo de hashing.

    //Informações do endereço
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    $usuarioDAO = new UserDAO();

    //Irá verificar se o CNPJ já está cadastrado
    if ($usuarioDAO->verificarDocumento($documento) > 0) {
        // CNPJ já cadastrado, retorna página de erro

        session_start();
        
        $_SESSION["erroDocumento"] = $documento;
    } 
    //Irá verificar se o Email já está cadastrado
    elseif ($usuarioDAO->verificarEmail($email) > 0){
        // Email já cadastrado, retorna página de erro

        session_start();
        
        $_SESSION["erroEmail"] = $email;
    }
    else {

        // Realizando o cadastro do endereço
        $endereco = new Address($logradouro, $numero, $complemento, $bairro, $cidade, $estado, $cep);
        $enderecoDAO = new AddressDAO();

        if($enderecoDAO->cadastrar($endereco)){
            // Cadastro do endereço bem sucedido, será iniciado o cadastro da empresa
            $empresa = new BusinessUser($nome, $documento, $email, $telefone, $endereco->get_id(), $segmento, $senha);
        }
        else{
            echo "Ocorreu um erro inesperado no cadastro do endereço.";
            exit();
        }

        if($usuarioDAO->cadastrar($empresa)){
            // Cadastro da empresa bem sucedido, direcionar para o usuário efetuar o login.
            session_start();
        
            $_SESSION["cadastrado"] = "Cadastro realizado com sucesso!";

            header("Location: ../view/login.php");
            exit();
        }
        else{
            echo "Ocorreu um erro inesperado no cadastro da empresa.";
        }
    }

    header("Location: ../view/businessRegistration.php");
?>
