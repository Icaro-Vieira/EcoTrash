<?php

    require_once("../model/CollectionPoints.php");
    require_once("../model/CollectionPointsDAO.php");

    //Id do ponto
    $idPonto = $_POST['idPonto']; 

    session_start();
    $usuario = $_SESSION['usuario'];
    $idUsuario = $usuario->get_id();

    $pontoDeColetaDAO = new CollectionPointsDAO();

    $pontoDeColeta = $pontoDeColetaDAO->excluir_ponto($idPonto, $idUsuario);

    //Irá verificar se o ponto existe
    if (!$pontoDeColeta) {
        
        session_start();
        
        $_SESSION["erroExcluirPonto"] = true;

        header("Location: ../view/businessProfile.php");
    } else {

        $_SESSION["excluido"] = true;
        header("Location: ../view/ListPoints.php");
    }

?>
