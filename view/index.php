<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="assets/css/index.css" />
  <title>EcoTrash</title>
</head>

<body>
  <nav>
    <div class="img">
      <img class="logo" src="img/horizontal-logo.svg" alt="Logo EcoTrash, um circulo com o simbolo de um botão power com duas folhas em cima dele" />
    </div>
    <div>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#articles">Artigos</a></li>
        <li><a href="#faq">Perguntas Frequentes</a></li>
      </ul>
    </div>
    <?php
      //Verificando se o usuário está logado

      session_start();

      $logado = isset($_SESSION['usuario']);

      if ($logado) {

        $tipoDeUsuário = $_SESSION['tipoDeUsuário'];

        if ($tipoDeUsuário == "J") {
          echo '<a href="businessProfile.php" class="login">
                  <button class="button">
                    <img src="img/icon-business-profile.svg" alt=""> 
                    Perfil Empresa
                  </button>
                </a>';
        } else {
          echo '<a href="userProfile.php" class="login">
                  <button class="button">
                    <img src="img/icon-user-profile.svg" alt=""> 
                    Meu Perfil
                  </button>
                </a>';
        }

        echo '<form action="../controller/ExitUser.php" method="post">
                  <button type="submit" class="button">Sair</button>
              </form>';
      } else {
        echo '<a href="login.php" class="login">
                <button class="button">Entrar</button>
              </a>';
      }
    ?>
  </nav>

  <main class="container">
    <section class="section-map">
      <h3 class="h3-map">Pesquise o ponto de coleta mais próximo de você</h3>
      <form action="" method="">
        <input type="text" placeholder="Digite o tipo de material que deseja descartar..." />
        <button type="submit" class="search-button"><img src="img/icon-search.svg" /></button>
      </form>
      <div class="map"></div>
    </section>

    <h3 id="artigo">Artigos</h3>
    <article id="articles">
      <div class="article">
        <img src="img/img-article-one.jpg"
          alt="Imagem de uma placa eletronica de computador, autor da imagem jorge salvador, fonte unsplash." />
        <p class="article-title">Lixo eletrônico e lixo digital – entenda as diferenças entre eles</p>
        <div class="span">
          <a href="article-one.html" target="_blank">
            <button class="button-article">
              <img src="img/icon-world-web.svg">
              Ler artigo
            </button>
          </a>
        </div>
      </div>
      </div>

      <div class="article">
        <img
          src="https://images.unsplash.com/photo-1604187351574-c75ca79f5807?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
          alt="" />
        <p class="article-title">ONU alerta que apenas 3% do lixo eletrônico da AL é reciclado</p>
        <div class="span">
          <a href="article-two.html" target="_blank">
            <button class="button-article">
              <img src="img/icon-world-web.svg">
              Ler artigo
            </button>
          </a>
        </div>
      </div>

      <div class="article">
        <img src="img/logo-onu-with-backgroun.svg" alt="" />
        <p class="article-title">Objetivos de Desenvolvimento Sustentável</p>
        <div class="span">
          <a href="https://brasil.un.org/pt-br/sdgs#:~:text=Os%20Objetivos%20de%20Desenvolvimento%20Sustent%C3%A1vel%20s%C3%A3o%20um%20apelo%20global%20%C3%A0,de%20paz%20e%20de%20prosperidade."
            target="_blank">
            <button class="button-article">
              <img src="img/icon-world-web.svg">
              Saiba mais
            </button>
          </a>
        </div>
      </div>
    </article>
    <section id="faq"></section>
  </main>

  <div class="line-footer"></div>
  <footer class="container">
    <img src="img/horizontal-logo.svg"
      alt="Logo EcoTrash, um circulo com o simbolo de um botão power com duas folhas em cima dele" />

    <div class="footer-div">
      <div class="footer-div-buttons">
        <button>Voltar ao topo</button>
        <a href="termsofUse.html" target="_blank">
          <button>Termos de uso</button>
        </a>
      </div>
      <p>Copyright © 2023. Todos os direitos reservados</p>
    </div>
  </footer>
</body>

</html>