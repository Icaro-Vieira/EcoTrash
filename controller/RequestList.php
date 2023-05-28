<?php

    require_once("../model/PersonalUser.php");
    require_once("../model/BusinessUser.php");
    require_once("../model/UserDAO.php");
    require_once("../model/CollectionPoints.php");
    require_once("../model/CollectionPointsDAO.php");
    require_once("../model/PointRequestDAO.php");

    session_start();
    if(isset($_SESSION['listaSolicitacoes'])){
        unset($_SESSION['listaSolicitacoes']);
    }
    
    $solicitacaoPontosDAO = new PointRequestDAO();

    $listaSolicitacoes = $solicitacaoPontosDAO->listaSolicitacoes();
    $listaSolicitacoesExibir = "";

    foreach($listaSolicitacoes as $ponto){
        $listaSolicitacoesExibir .= "
        <table>
            <tr>
                <td>ID</td>
                <td>NOME</td>
                <td>CEP</td>
            </tr>
            <tr>
                <td>{$ponto->get_id()}</td>
                <td>{$ponto->get_descricao()}</td>
                <td>{$ponto->get_cep()}</td>
            </tr>
        </table>";
    }

    // echo '
        //       <table class="table-info">
        //       <tr>
        //         <th>Nome</th>
        //         <th>Logradouro</th>
        //         <th>CEP</th>
        //         <th>Editar</th>
        //       </tr>
        //       <tr>';

    session_start();
    if($listaSolicitacoesExibir != ""){
        $_SESSION["listaSolicitacoes"] = $listaSolicitacoesExibir;
    }

    header("Location: ../view/admProfile.php");

?>