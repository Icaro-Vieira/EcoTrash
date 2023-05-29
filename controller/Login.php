<?php

    require_once("../model/UserDAO.php");
    require_once("../model/AddressDAO.php");

    $documento = $_POST['usuario'];
    $senha = $_POST['senha'];

    $usuarioDAO = new UserDAO();
    $enderecoDAO = new AddressDAO();

    $usuario = $usuarioDAO->consultar_documento($documento);
    $login = $usuarioDAO->login($usuario, $senha);
    
    if($login){

        $idEndereco = $usuarioDAO->buscarIdEndereco($documento);
        $endereco = $enderecoDAO->consultarEndereco($idEndereco);

        session_start();
        
        $_SESSION["usuario"] = $usuario;
        $_SESSION["endereco"] = $endereco;

        header("Location: ../view/index.php");
        exit();
    }
    else{
        session_start();
        $_SESSION["error"] = true; // Essa session irá permitir que seja exibido um erro na tela

        header("Location: ../view/login.php");
    }
?>
