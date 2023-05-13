<?php

    require_once("../model/UserDAO.php");

    $documento = $_POST['usuario'];
    $senha = $_POST['senha'];

    $usuarioDAO = new UserDAO();

    $usuario = $usuarioDAO->consultar_documento($documento);
    $login = $usuarioDAO->login($usuario, $senha);

    if($login){
        header("Location: http://localhost/PA/EcoTrash/index.html");
    }
    else{
        header("Location: http://localhost/PA/EcoTrash/emailousenhaerrados.html"); //Aviso na tela
    }

?>
