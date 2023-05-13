<?php

    require_once("../model/PersonalUser.php");
    require_once("../model/UserDAO.php");
    require_once("../model/Address.php");
    require_once("../model/AddressDAO.php");

    //Inoformações da PF
    $nome = ($_POST['nome'] . $_POST['sobrenome']); 
    $dataNascimento = $_POST['data-nasc'];
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

    $endereco = new Address($logradouro, $numero, $complemento, $bairro, $cidade, $estado, $cep);
    $enderecoDAO = new AddressDAO();

    if($enderecoDAO->cadastrar($endereco) == false){
        header("Location: ../view/Erro.html");
    }

    $usuario = new PersonalUser($nome, $dataNascimento, $documento, $email, $telefone, $endereco->get_id(), $senha);
    $usuarioDAO = new UserDAO();

    if($usuarioDAO->cadastrar($usuario)){
        header("Location: ../view/cadastroRealizado.html");
    }
    else{
        header("Location: ../view/cadastroProblema.html");
    }

?>
