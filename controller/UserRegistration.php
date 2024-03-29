<?php

    require_once("../model/PersonalUser.php");
    require_once("../model/UserDAO.php");
    require_once("../model/Address.php");
    require_once("../model/AddressDAO.php");

    //Inoformações da PF
    $nome = $_POST['nome']; 
    $sobrenome = $_POST['sobrenome'];
    $documento = $_POST['cpf']; 
    $email = $_POST['email']; 
    $telefone = $_POST['telefone'];  
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

    //Informações do endereço
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    $usuarioDAO = new UserDAO();

    //Irá verificar se o CPF já está cadastrado
    if ($usuarioDAO->verificarDocumento($documento) > 0) {
        // CPF já cadastrado, retorna página de erro

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
            $usuario = new PersonalUser($nome, $sobrenome, $documento, $email, $telefone, $endereco->get_id(), $senha);
        }
        else{
            echo "Ocorreu um erro inesperado no cadastro do endereço.";
            exit();
        }

        if($usuarioDAO->cadastrar($usuario)){
            // Cadastro da Pessoa Física bem sucedido, direcionar para o usuário efetuar o login.
            session_start();
        
            $_SESSION["cadastrado"] = "Cadastro realizado com sucesso!";

            header("Location: ../view/login.php");
            exit();
        }
        else{
            echo "Ocorreu um erro inesperado no cadastro.";
        }
    }

    header("Location: ../view/userRegistration.php");
?>
