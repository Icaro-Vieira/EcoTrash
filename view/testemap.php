<?php
  // Conecta ao banco de dados
  $conn = mysqli_connect("localhost", "root", "Ec@305três*", "ecotrash");

  // Verifica se a conexão foi bem sucedida
  if (!$conn) {
    die("Conexão falhou: " .mysqli_connect_error());
  }

  // Query para recuperar os pontos de coleta
  $sql = "SELECT ID, DESCRICAO, LATITUDE, LONGITUDE FROM pontos_coleta";

  // Executa a query
  $result = mysqli_query($conn, $sql);

  // Cria um array vazio para armazenar os pontos de coleta
  $points = array();

  // Loop através dos resultados da query
  while ($row = mysqli_fetch_assoc($result)) {
    // Adiciona os dados do ponto de coleta ao array
    $point = array(
      'id' => $row['ID'],
      'descricao' => $row['DESCRICAO'],
      'latitude' => $row['LATITUDE'],
      'longitude' => $row['LONGITUDE']
    );
    array_push($points, $point);
  }

  // Converte o array em JSON
  $json = json_encode($points);

  // Fecha a conexão com o banco de dados
  mysqli_close($conn);

  // Retorna o JSON
  echo $json;
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Mapa de Pontos de Coleta</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Estilo do mapa */
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>
    <!-- Campo de busca -->
    <input type="text" id="search" placeholder="Digite a descrição do ponto de coleta">
    <button id="btnBusca">Buscar</button>
    
    <!-- Mapa -->
    <div id="map"></div>

    <script>
      // Inicializa o mapa
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: {lat: -23.5505, lng: -46.6333} // São Paulo, Brasil
        });

        // Recupera os pontos de coleta do JSON gerado pelo PHP
        var pontosDeColeta = <?php echo $json; ?>;

        // Cria um marcador para cada ponto de coleta
        var markers = [];
        for (var i = 0; i < pontosDeColeta.length; i++) {
          var pontoDeColeta = pontosDeColeta[i];
          var marker = new google.maps.Marker({
            position: {lat: parseFloat(pontoDeColeta.latitude), lng: parseFloat(pontoDeColeta.longitude)},
            map: map,
            title: pontoDeColeta.descricao,
            icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png' // ícone verde escuro
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
  </body>
</html>