<?php

require_once("../model/PersonalUser.php");
require_once("../model/BusinessUser.php");
require_once("../model/UserDAO.php");
require_once("../model/Address.php");
require_once("../model/AddressDAO.php");

session_start();

$logado = isset($_SESSION['usuario']);
$ErroSolicitacao = isset($_SESSION["erroCadastrarPonto"]);

if (!$logado) {
  header("Location: login.php");
} else {
  $usuario = $_SESSION['usuario'];
}

if ($ErroSolicitacao) {
  $idSolicitacao = $_SESSION["erroCadastrarPonto"];

  echo '<script> alert("ID: ' . $idSolicitacao . ' não foi encontrado na base de dados!"); </script>';
}

unset($_SESSION['erroCadastrarPonto']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="assets/css/profile.css" />
  <title>EcoTrash - Perfil Administrador</title>
</head>

<body id="register">
  <nav class="navigation">
    <ul>
      <li><a class="back-button" href="index.php"><img src="img/arow-back.svg" alt="">Voltar</a></li>
      <li><a href="index.php"><img src="img/horizontal-white-logo.svg" alt=""></a></li>
    </ul>
  </nav>
  <div class="bg-nav"></div>
  <div class="profile-divisor">
    <article class="info-user">
      <img src="img/icon-shield-profile.svg" alt="">
      <h1>
        <?php
          echo $usuario->get_nome() . " " . $usuario->get_sobrenome();
        ?>
      </h1>
      <p>
        <?php
          echo $usuario->get_email();
        ?>
      </p>
    </article>

    <article class="form-user-adm">
      <?php
      if (isset($_SESSION["listaSolicitacoes"])) {

        $lista = $_SESSION['listaSolicitacoes'];

        // echo '
        //       <table class="table-info">
        //       <tr>
        //         <th>Nome</th>
        //         <th>Logradouro</th>
        //         <th>CEP</th>
        //         <th>Editar</th>
        //       </tr>
        //       <tr>';

        echo "<table class='table-info'>{$lista}</table>";

        echo '
            <div class="forms-divider-points">
                <form action="../controller/RegistrationCollectionPoint.php" method="POST" class="form-control">
                  <label for="">
                    <input type="number" name="idSolicitacao" id="idSolicitacao" placeholder="Insira o ID da solicitação para aprova-la: " required>
                  </label>
                  <button class="trash-button"><img src="img/add-icon.svg"></button>
                </form>

                <form action="../controller/DeleteRequest.php" method="POST" class="form-control">
                  <label for="">
                    <input type="number" name="idSolicitacao" id="idSolicitacao" placeholder="Insira o ID da solicitação para reprova-la: " required>
                  </label>
                  <button class="trash-button"><img src="img/remove-icon.svg"></button>
                </form>
              </table>
            </div>
        ';
      } else {
        echo "
            <div class='div-point'>
              <p class='p-point'>Não há cadastros de pontos de coleta 🗑️</p>
            </div>
          ";
      }
      ?>
    </article>
  </div>
</body>

</html>