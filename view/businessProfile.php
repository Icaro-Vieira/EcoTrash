<?php

  require_once("../model/PersonalUser.php");
  require_once("../model/BusinessUser.php");
  require_once("../model/UserDAO.php");
  require_once("../model/Address.php");
  require_once("../model/AddressDAO.php");

  session_start();

  $logado = isset($_SESSION['usuario']);
  $excluido = isset($_SESSION["excluido"]);
  $listaPontos = isset($_SESSION["listaCadastrosPontos"]);

  if (!$logado) {
    header("Location: login.php");
  } else {
    $usuario = $_SESSION['usuario'];
  }

  if ($excluido) {
    echo '<script> alert("Ponto de coleta excluído com sucesso!"); </script>';
  }

  unset($_SESSION['excluido']);

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
      <img src="img/icon-business.svg" alt="">
      <h1>
        <?php
        echo $usuario->get_nome();
        ?>
      </h1>
      <p>
        <?php
        echo $usuario->get_documento();
        ?>
      </p>
      <a class="a-button-del button-del" href="#" onclick="showConfirmationAlert()">
        Deletar conta
      </a>
    </article>

    <article class="form-business-bg buttons-and-feedback">
        <div class="top-buttons-profile only-buttons">
          <a href="businessProfile.php" class="edit-button active">Pontos Cadastrados</a>
          <a href="registerPoints.php" class="edit-button border-bottom">Cadastrar Pontos</a>
        </div>
            <?php
              if ($listaPontos) {

                $lista = $_SESSION["listaCadastrosPontos"];

                echo "
                  <div class='align-table'>
                    <table class='table-info'>
                      <tr>
                        <td><strong>ID</strong></td>
                        <td><strong>NOME</strong></td>
                        <td><strong>CEP</strong></td>
                      </tr>
                      {$lista}
                    </table>
                  </div>";

                echo '
                <form class="form-control" action="../controller/DeletePoint.php" method="POST">
                    <label for="">
                      <input class="input-point" type="text" name="idPonto" id="idPonto" placeholder="Insira o ID para remover" required>
                    </label>
                    
                    <button class="trash-button"><img src="img/trash-icon.svg"></button>
                </form>';

              } else {
                echo "
                    <div class='div-point'>
                      <p class='p-point'>Não há cadastros de pontos de coleta ♻️</p>
                    </div>
                  ";
              }
            ?>
    </article>
  </div>

  <script type="module" src="assets/js/script.js"></script>
  <script src="assets/js/modules/api-cep.js"></script>

  <script>
    function showConfirmationAlert() {
      // Exibir o alerta de confirmação
      var confirmation = prompt('Digite "DELETAR MINHA CONTA" para confirmar:');

      if (confirmation === 'DELETAR MINHA CONTA') {
        // Chamar a função DeleteUser.php ou redirecionar
        window.location.href = '../controller/DeleteUser.php';
      } else {
        // Valor incorreto, exibir mensagem de erro
        alert('Digite corretamente: "DELETAR MINHA CONTA", caso queira deletar sua conta!');
      }
    }
  </script>
</body>

</html>