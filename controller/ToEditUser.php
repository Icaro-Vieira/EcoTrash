<?php

    require_once("../model/PersonalUser.php");
    require_once("../model/UserDAO.php");
    require_once("../model/Address.php");
    require_once("../model/AddressDAO.php");

    session_start();
    $usuario = $_SESSION['usuario'];
    $documento = $usuario->get_documento();

    //Inoformações para edição do usuário
    $nome = ($_POST['nome'] . " " . $_POST['sobrenome']); 
    $email = $_POST['email']; 
    $telefone = $_POST['telefone'];  
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

    //Informações para edição do endereço
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    $usuarioDAO = new UserDAO();
    $enderecoDAO = new AddressDAO();

    $idEndereco = $usuarioDAO->buscarIdEndereco($documento);

    $editar = $usuarioDAO->editar_usuario($documento, $nome, $email, $telefone, $senha);
    $editar_endereco = $enderecoDAO->editar_endereco($idEndereco, $logradouro, $numero, $complemento, $bairro, $cidade, $estado, $cep);

    if($editar){
        
        if($editar_endereco){

            session_start();

            $usuario = $usuarioDAO->consultar_documento($documento);
            $_SESSION["usuario"] = $usuario;

            $_SESSION["atualizado"] = "Perfil atualizado com sucesso!";

            header("Location: ../view/userProfile.php");
    
        }
        else{
            echo "Ocorreu um erro inesperado na edição do endereço.";
        }

    }
    else{
        echo "Não foi possível realizar a edição do usuário.";
    }

?>
