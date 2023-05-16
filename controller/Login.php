<?php

    require_once("../model/UserDAO.php");

    $documento = $_POST['usuario'];
    $senha = $_POST['senha'];

    $usuarioDAO = new UserDAO();

    $usuario = $usuarioDAO->consultar_documento($documento);
    $login = $usuarioDAO->login($usuario, $senha);

    if($login){
        session_start();
        
        $_SESSION["usuario"] = $usuario;
        $_SESSION["tipoDeUsuário"] = $usuario->get_tipoUsuario();

        header("Location: http://localhost/ProjetoAplicado/EcoTrash/view/index.php");
    }
    else{
        session_start();
        $_SESSION["error"] = "erroLogin"; // Essa session irá permitir que seja exibido um erro na tela

        header("Location: http://localhost/ProjetoAplicado/EcoTrash/view/login.php");
    }

?>
