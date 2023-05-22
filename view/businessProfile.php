<?php

  require_once("../model/PersonalUser.php");
  require_once("../model/BusinessUser.php");
  require_once("../model/UserDAO.php");

  session_start();

  $logado = isset($_SESSION['usuario']);

  if(!$logado){
    
    header("Location: login.php");
    exit();
  }
  else{
    $usuario = $_SESSION['usuario'];
  }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="assets/css/profile.css" />
  <title>EcoTrash - Perfil Empresa</title>
</head>

<body>

<p><?php echo $usuario->get_documento(); ?></p>

<a href="../controller/DeleteUser.php">
  <button class="button">
    Deletar
  </button>
</a>
  
</body>

</html>