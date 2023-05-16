<?php

    require_once("../model/PersonalUser.php");
    require_once("../model/BusinessUser.php");
    require_once("../model/UserDAO.php");
    require_once("../model/AddressDAO.php");

    session_start();
    $usuario = $_SESSION['usuario'];
    $documento = $usuario->get_documento();

    $usuarioDAO = new UserDAO();
    $enderecoDAO = new AddressDAO();

    $idEndereco = $usuarioDAO->buscarIdEndereco($documento);

    if($usuarioDAO->excluir_usuario($documento)){

        if($enderecoDAO->excluir_endereco($idEndereco)){

            session_destroy();
            
            header("Location: ../view/index.php");
        }
        else{
            echo "Ocorreu um erro inesperado na exclusão do endereço.";
        }
    }
    else{
        echo "Não foi possível realizar a exclusão do usuário.";
    }

?>
