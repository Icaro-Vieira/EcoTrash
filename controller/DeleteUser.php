<?php

    require_once("../model/UserDAO.php");
    require_once("../model/AddressDAO.php");
    require_once("../model/CollectionPointsDAO.php");

    $documento = $_POST['documento'];

    $usuarioDAO = new UserDAO();
    $enderecoDAO = new AddressDAO();
    $pontoDeColetaDAO = new CollectionPointsDAO();

    $idEndereco = $usuarioDAO->buscarIdEndereco($documento);

    $consultarPontoDeColeta = $pontoDeColetaDAO->consultar_pontoDeColetaPeloID($idEndereco);
    $verificarEndereco = $usuarioDAO->verificarEnderecoEmOutroCadastro($idEndereco);
        
    if(($consultarPontoDeColeta == null) && !$verificarEndereco){
        $excluirEndereco = $enderecoDAO->excluir_endereco($idEndereco);
    }

    if($usuarioDAO->excluir_usuario($documento)){
        header("Location: ../view/DeletarSucesso.html");
    }
    else{
        header("Location: ../view/DeletarProblema.html");
    }

?>
