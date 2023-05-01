<?php

    require_once("../model/CadastroPJ.php");
    require_once("../model/CadastroDAO.php");

    $documento = $_POST['usuario'];
    $senha = $_POST['senha'];

    $cadastroDAO = new CadastroDAO();

    $login = $cadastroDAO->login($documento, $senha);

    if($login){
        header("Location: ../view/loginRealizado.html");
    }
    elseif ($login == "nao existe"){
        header("Location: ../view/usuarionãocadastrado.html");
    }
    else{
        header("Location: ../view/emailousenhaerrados.html");
    }

?>
