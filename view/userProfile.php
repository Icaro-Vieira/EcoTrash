<?php

  require_once("../model/PersonalUser.php");
  require_once("../model/BusinessUser.php");
  require_once("../model/UserDAO.php");

  session_start();

  $logado = isset($_SESSION['usuario']);
  $atualizado = isset($_SESSION['atualizado']);

  if(!$logado){
    
    header("Location: login.php");
    exit();
  }
  else{

    if($atualizado){
      echo '<script> alert("Perfil atualizado com sucesso!"); </script>';
    }

    $usuario = $_SESSION['usuario'];
  }

  unset($_SESSION['atualizado']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="assets/css/profile.css" />
  <title>EcoTrash - Meu Perfil</title>
</head>

<body>

<article class="form-bg">

  <p>Olá bem vinda <?php echo $usuario->get_nome(); ?></p>

            <form action="../controller/ToEditUser.php" method="POST">
                <article class="form-column">
                    <label for="">
                        <input type="text" name="nome" id="nome" placeholder="Nome" required>
                    </label>

                    <label for="">
                        <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" required>
                    </label>

                    <label for="">
                        <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" required>
                    </label>

                    <label for="">
                        <input type="text" name="cep" id="cep" placeholder="CEP" autocomplete="off" maxlength="9" required>
                    </label>

                    <label for="">
                        <input type="tel" name="telefone" id="telefone" placeholder="Telefone" required>
                    </label>

                    <label for="">
                        <input type="text" name="complemento" placeholder="Complemento">
                    </label>

                    <article class="two-inputs">
                        <label for="">
                            <input type="text" name="logradouro" id="logradouro" class="medium-input"
                                placeholder="Logradouro" required>
                        </label>

                        <label for="">
                            <input type="number" name="numero" class="little-input" placeholder="Número" maxlength="15" min="0" autocomplete="off"
                                required>
                        </label>
                    </article>

                    <label for="">
                        <input type="text" name="bairro" id="bairro" placeholder="Bairro">
                    </label>

                    <article class="two-inputs">
                        <label for="">
                            <input type="text" name="cidade" id="cidade" class="medium-input" placeholder="Cidade">
                        </label>

                        <label for="">
                            <input type="text" name="estado" id="estado" class="little-input" placeholder="Estado">
                        </label>
                    </article>

                    <!-- ADD EYE TO SEE PASSWORD and CONFIRM PASSWORD -->
                    <label for="" class="icon-pass">
                        <input type="password" name="senha" id="senha" placeholder="Senha" maxlength="8" required>
                        <img class="imagem-icon" src="img/eye-visibility-off.svg" alt="mostrar senha">
                    </label>

                    <label for="" class="icon-pass">
                        <input type="password" name="confirmar-senha" id="confirmar-senha" placeholder="Confirmar Senha" maxlength="8"
                            required>
                        <img class="imagem-icon2" src="img/eye-visibility-off.svg" alt="mostrar senha">
                    </label>

                        <input type="submit" value="Editar">
                </article>
            </form>
        </article>

<a href="../controller/DeleteUser.php">
  <button class="button">
    Deletar
  </button>
</a>
  
</body>

</html>