<?php

    require_once("../model/CollectionPoints.php");
    require_once("../model/CollectionPointsDAO.php");
    require_once("../model/PointRequestDAO.php");

    //Id da solicitação
    $idSolicitacao = $_POST['idSolicitacao']; 

    $solicitacaoDAO = new PointRequestDAO();

    if($solicitacaoDAO->excluir_solicitacao($idSolicitacao)){

        header("Location: ../view/admProfile.php");
    }
    else{
        echo "Não foi possível realizar a exclusão da solicitação.";
    }

?>
