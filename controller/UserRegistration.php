<?php

    require_once("../model/PersonalUser.php");
    require_once("../model/UserDAO.php");
    require_once("../model/Address.php");
    require_once("../model/AddressDAO.php");

    //Inoformações da PF
    $nome = ($_POST['nome'] . " " . $_POST['sobrenome']); 
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

    //Irá verificar se o CNPJ já está cadastrado
    if ($usuarioDAO->verificarDocumento($documento) > 0) {
        // CPF já cadastrado, retorna página de erro
        header("Location: ../view/documentAlreadyRegistered.html");
    } 
    //Irá verificar se o Email já está cadastrado
    elseif ($usuarioDAO->verificarEmail($email) > 0){
        // Email já cadastrado, retorna página de erro
        header("Location: ../view/emailAlreadyRegistered.html");
    }
    else {

        // Realizando o cadastro do endereço
        $endereco = new Address($logradouro, $numero, $complemento, $bairro, $cidade, $estado, $cep);
        $enderecoDAO = new AddressDAO();

        if($enderecoDAO->cadastrar($endereco)){
            // Cadastro do endereço bem sucedido, será iniciado o cadastro da empresa
            $usuario = new PersonalUser($nome, $documento, $email, $telefone, $endereco->get_id(), $senha);
        }
        else{
            echo "Ocorreu um erro inesperado no cadastro do endereço.";
        }

        if($usuarioDAO->cadastrar($usuario)){
            // Cadastro da Pessoa Física bem sucedido, direcionar para o usuário efetuar o login.
            header("Location: ../view/login.html");
        }
        else{
            echo "Ocorreu um erro inesperado no cadastro.";
        }
    }

?>
