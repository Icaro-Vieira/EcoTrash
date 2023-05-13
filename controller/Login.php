<?php

    require_once("../model/UserDAO.php");

    $documento = $_POST['usuario'];
    $senha = $_POST['senha'];

    $usuarioDAO = new UserDAO();

    $login = $usuarioDAO->login($documento, $senha);

    if($login){
        header("Location: http://localhost/PA/EcoTrash/index.html");
    }
    else{
        header("Location: http://localhost/PA/EcoTrash/emailousenhaerrados.html"); //Aviso na tela
    }

?>
