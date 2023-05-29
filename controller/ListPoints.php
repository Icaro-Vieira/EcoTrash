<?php

    require_once("../model/PersonalUser.php");
    require_once("../model/BusinessUser.php");
    require_once("../model/UserDAO.php");
    require_once("../model/CollectionPoints.php");
    require_once("../model/CollectionPointsDAO.php");
    require_once("../model/PointRequestDAO.php");

    session_start();
    if(isset($_SESSION['listaCadastrosPontos'])){
        unset($_SESSION['listaCadastrosPontos']);
    }

    //Informação do usuário que realizou o cadastro
    $usuario = $_SESSION['usuario'];
    $idUsuario = $usuario->get_id();
    
    $pontosDeColetaDAO = new CollectionPointsDAO();

    $listaCadastrosPontos = $pontosDeColetaDAO->listaCadastrosPontos($idUsuario);
    $listaCadastrosPontosExibir = "";

    foreach($listaCadastrosPontos as $ponto){
        $listaCadastrosPontosExibir .= "
            <tr>
                <td>{$ponto->get_id()}</td>
                <td>{$ponto->get_descricao()}</td>
                <td>{$ponto->get_cep()}</td>
            </tr>";
    }

    if($listaCadastrosPontosExibir != ""){
        $_SESSION["listaCadastrosPontos"] = $listaCadastrosPontosExibir;
    }

    header("Location: ../view/businessProfile.php");

?>