<?php

  require_once("../model/PersonalUser.php");
  require_once("../model/BusinessUser.php");
  require_once("../model/UserDAO.php");
  require_once("../model/Address.php");
  require_once("../model/AddressDAO.php");


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
    $endereco = $_SESSION['endereco'];
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
            <img src="img/icon-user.svg" alt="">
            <h1>
                <?php 
                    echo $usuario->get_nome() . " " . $usuario->get_sobrenome(); 
                ?>
            </h1>
            <p>
                <?php 
                    echo $usuario->get_documento(); 
                ?>
            </p>            
            <a class="a-button-del" href="../controller/DeleteUser.php">
                <button class="button-del">
                    Deletar conta
                </button>
            </a>
        </article>
    
        <article class="form-user-bg">
            <form action="../controller/ToEditUser.php" method="POST">
                <!-- Falta Editar o CSS dos Botões e fazer paginação, WIP - 18/05/23 -->
                <div class="top-buttons-profile">
                    <button class="edit-button active">Editar Perfil</button>
                    <button class="request-register">Solicitar Cadastro</button>
                </div>

                <article class="form-column">
                    <label for="">
                        <input type="text" name="nome" id="nome" placeholder="Nome" value="<?php echo $usuario->get_nome(); ?>" required>
                    </label>
    
                    <label for="">
                        <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" value="<?php echo $usuario->get_sobrenome(); ?>" required>
                    </label>
    
                    <label for="">
                        <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" value="<?php echo $usuario->get_email(); ?>"required>
                    </label>
    
                    <label for="">
                        <input type="text" name="cep" id="cep" placeholder="CEP" autocomplete="off" value="<?php echo $endereco->get_cep(); ?>" maxlength="9" required>
                    </label>
    
                    <label for="">
                        <input type="tel" name="telefone" id="telefone" placeholder="Telefone"  value="<?php echo $usuario->get_telefone(); ?>" required>
                    </label>
    
                    <label for="">
                        <input type="text" name="complemento" placeholder="Complemento" value="<?php echo $endereco->get_complemento(); ?>" >
                    </label>
    
                    <article class="two-inputs">
                        <label for="">
                            <input type="text" name="logradouro" id="logradouro" class="medium-input" placeholder="Logradouro" value="<?php echo $endereco->get_logradouro(); ?>"  required>
                        </label>
    
                        <label for="">
                            <input type="number" name="numero" class="little-input" placeholder="Número" maxlength="15" min="0" autocomplete="off"  value="<?php echo $endereco->get_numero(); ?>" required>
                        </label>
                    </article>
    
                    <label for="">
                        <input type="text" name="bairro" id="bairro" placeholder="Bairro" value="<?php echo $endereco->get_bairro(); ?>" >
                    </label>
    
                    <label for="">
                        <input type="text" name="cidade" id="cidade" placeholder="Cidade" value="<?php echo $endereco->get_cidade()?>">
                    </label>
    
                    <label for="">
                        <input type="text" name="estado" id="estado" placeholder="Estado" value="<?php echo $endereco->get_estado()?>">
                    </label>
    
                    <article class="center-terms-submit">
                        <article class="terms-of-use">
                            <input type="checkbox" name="termos-aceito" id="" required>
                            <label for="">Confirmo que verifiquei meus dados!</span></label>
                        </article>
                        <input type="submit" value="Editar">
                    </article>
    
                </article>
            </form>
        </article>
    </div>

    <script type="module" src="assets/js/script.js"></script>
    <script src="assets/js/modules/eye-button.js"></script>
    <script src="assets/js/modules/input-mask.js"></script>
</body>
</html>