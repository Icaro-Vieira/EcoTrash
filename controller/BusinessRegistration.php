<?php

    require_once("../model/BusinessUser.php");
    require_once("../model/CadastroDAO.php");
    require_once("../model/Address.php");
    require_once("../model/AddressDAO.php");

    //Inoformações da PJ
    $nome = $_POST['nome-empresa']; 
    $documento = $_POST['cnpj']; 
    $email = $_POST['email']; 
    $telefone = $_POST['telefone']; 
    $segmento = $_POST['segmento-empresa']; 
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

    $empresa = new BusinessUser($nome, $documento, $email, $telefone, $endereco->get_id(), $segmento, $senha);
    $cadastroDAO = new CadastroDAO();

    if($cadastroDAO->cadastrar($empresa)){
        header("Location: ../view/cadastroRealizado.html");
    }
    else{
        header("Location: ../view/cadastroProblema.html");
    }

?>
