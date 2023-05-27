<?php
require_once("../model/PersonalUser.php");
require_once("../model/BusinessUser.php");
require_once("../model/UserDAO.php");

session_start();

$logado = isset($_SESSION['usuario']);


// Conecta ao banco de dados
$conn = mysqli_connect("localhost", "root", "", "ecotrash3");

// Verifica se a conexão foi bem sucedida
if (!$conn) {
  die("Conexão falhou: " . mysqli_connect_error());
}

// Query para recuperar os pontos de coleta
$sql = "SELECT ID, DESCRICAO, CEP, NUMERO, TIPOMATERIAIS FROM pontos_coleta";

// Executa a query
$result = mysqli_query($conn, $sql);

// Cria um array vazio para armazenar os pontos de coleta
$points = array();

function getLatLng($cep, $numero)
{
  $endereco = urlencode($cep . ', ' . $numero);
  $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$endereco&key=AIzaSyAfPGguvEqU_Wegb0tPyDxD-mUatDKtDVM";
  $json = file_get_contents($url);
  $data = json_decode($json);

  if ($data->status == 'OK') {
    $lat = $data->results[0]->geometry->location->lat;
    $lng = $data->results[0]->geometry->location->lng;
    return array('lat' => $lat, 'lng' => $lng);
  } else {
    return null;
  }
}

// Loop através dos resultados da query
while ($row = mysqli_fetch_assoc($result)) {

  $lat = null;
  $lng = null;

  // Adiciona os dados do ponto de coleta ao array
  $endereco = getLatLng($row['CEP'], $row['NUMERO']);
  if ($endereco) {
    $lat = $endereco['lat'];
    $lng = $endereco['lng'];
  }

  $point = array(
    'id' => $row['ID'],
    'descricao' => $row['DESCRICAO'],
    'latitude' => $lat,
    'longitude' => $lng,
    'tipoMateriais' => $row['TIPOMATERIAIS']
  );
  array_push($points, $point);
}

// Converte o array em JSON
$json = json_encode($points);

// Fecha a conexão com o banco de dados
mysqli_close($conn);

// Retorna o JSON
echo "<p style='display: none;'>{$json}</p>";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="assets/css/index.css" />
  <title>EcoTrash</title>
</head>

<body>
  <nav>
    <div class="img">
      <img class="logo" src="img/horizontal-logo.svg" alt="Logo EcoTrash, um circulo com o simbolo de um botão power com duas folhas em cima dele" />
    </div>
    <ul>
      <li><a href="#home">Home</a></li>
      <li><a href="#articles">Artigos</a></li>
      <li><a href="#faq">Perguntas Frequentes</a></li>
      <?php
      //Verificando se o usuário está logado
      if ($logado) {

        $usuario = $_SESSION['usuario'];

        if ($usuario->juridico()) {
          echo '<li>
                    <a href="../controller/ListPoints.php" class="login">
                      <button class="button">
                        <img src="img/icon-business-profile.svg"> 
                        Perfil Empresa
                      </button>
                    </a>
                  </li>';
        } else if (!$usuario->juridico() && ($usuario->get_documento() == "111.111.111-11")) {
          echo '<li>
                    <a href="../controller/RequestList.php" class="login">
                      <button class="button">
                        <img src="img/icon-business-profile.svg"> 
                        ADM
                      </button>
                    </a>
                  </li>';
        } else {
          echo '<li>
                    <a href="userProfile.php" class="login">
                      <button class="button">
                        <img src="img/icon-user-profile.svg"> 
                        Meu Perfil
                      </button>
                    </a>
                  </li>';
        }

        echo '<li>
                  <form action="../controller/ExitUser.php" method="post">
                    <button type="submit" class="exit-button">
                      <img src="img/exit.svg">
                      Sair
                    </button>
                  </form>
                </li>';
      } else {
        echo '<li>
                  <a href="login.php" class="login">
                    <button class="button">Entrar</button>
                  </a>
                </li>';
      }
      ?>
    </ul>

  </nav>

  <main class="container animate__animated animate__pulse">

    <br>
    <br>
    <h3 class="h3-map">Pesquise o ponto de coleta mais próximo de você</h3>
    <form>
      <input type="text" id="search" placeholder="Digite o tipo de material que deseja descartar..." />
      <button id="btnBusca"><img src="img/icon-search.svg" /></button>
    </form>
    <br>
    <br>

    <!-- Mapa -->
    <div id="map"></div>

    <style>
      /* Estilo do mapa */
      #map {
        height: 100%;
        border-radius: 16px;
      }
    </style>

    <script>
      // Inicializa o mapa
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: {
            lat: -23.5505,
            lng: -46.6333
          } // São Paulo, Brasil
        });

        // Recupera os pontos de coleta do JSON gerado pelo PHP
        var pontosDeColeta = <?php echo $json; ?>;

        // Cria um marcador para cada ponto de coleta
        var markers = [];
        for (var i = 0; i < pontosDeColeta.length; i++) {
          var pontoDeColeta = pontosDeColeta[i];
          var marker = new google.maps.Marker({
            position: {
              lat: parseFloat(pontoDeColeta.latitude),
              lng: parseFloat(pontoDeColeta.longitude)
            },
            map: map,
            title: pontoDeColeta.descricao,
            icon: 'https://i.ibb.co/60kw6cH/Pin-Mapa.png' // Ícone EcoTrash
            // icon maps: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png' 
            // ícone proprio do maps
          });
          markers.push(marker);

          // Adiciona um listener de clique para exibir a descrição do ponto de coleta
          marker.addListener('click', function() {
            var infoWindow = new google.maps.InfoWindow({
              content: this.title
            });
            infoWindow.open(map, this);
          });
        }

        // Adiciona um listener de eventos de clique para o botão de busca
        document.getElementById('btnBusca').addEventListener('click', function() {
          var filtro = document.getElementById('search').value.toLowerCase();
          if (filtro !== '') {
            for (var i = 0; i < markers.length; i++) {
              var marker = markers[i];
              if (marker.title.toLowerCase().indexOf(filtro) >= 0) {
                marker.setVisible(true);
              } else {
                marker.setVisible(false);
              }
            }
          }
        });

        // Adiciona um listener de eventos de digitação para o campo de busca
        document.getElementById('search').addEventListener('keyup', function() {
          var filtro = this.value.toLowerCase();
          for (var i = 0; i < markers.length; i++) {
            var marker = markers[i];
            if (marker.title.toLowerCase().indexOf(filtro) >= 0) {
              marker.setVisible(true);
            } else {
              marker.setVisible(false);
            }
          }
        });

        function atualizarMarcador(descricao) {
          for (var i = 0; i < markers.length; i++) {
            var marker = markers[i];
            if (marker.title.toLowerCase() === descricao.toLowerCase()) {
              map.setCenter(marker.getPosition());
              map.setZoom(15);
              marker.setVisible(true);
              return;
            }
          }
        }
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfPGguvEqU_Wegb0tPyDxD-mUatDKtDVM&callback=initMap"></script>

    <h3 id="artigo">Artigos</h3>
    <article id="articles">
      <div class="article">
        <img src="img/img-article-one.jpg" alt="Imagem de uma placa eletronica de computador, autor da imagem jorge salvador, fonte unsplash." />
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
        <img src="https://images.unsplash.com/photo-1604187351574-c75ca79f5807?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="" />
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
          <a href="https://brasil.un.org/pt-br/sdgs#:~:text=Os%20Objetivos%20de%20Desenvolvimento%20Sustent%C3%A1vel%20s%C3%A3o%20um%20apelo%20global%20%C3%A0,de%20paz%20e%20de%20prosperidade." target="_blank">
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
    <img src="img/horizontal-logo.svg" alt="Logo EcoTrash, um circulo com o simbolo de um botão power com duas folhas em cima dele" />

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