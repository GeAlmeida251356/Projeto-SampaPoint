<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="imagex/png" href="./adm/Imagens/Imagens_index/logo.png">
  <title>Mapa Geral</title>
  <style>

      body{
        margin: 0;
        background-color: #333333;
      }

      .seta img{
      margin: 5px;
      width: 15px;
      height: auto;
      position: relative;
    }
      
      #map {
        width: 100%;
		    height: 680px;
        margin: 0;
        top: 50%;
      }
  </style>
</head>
<body>
    <div class="seta">
        <a href="index_logado.php"><img src="./adm/Imagens/Imagens_index/seta_voltar.png"></a>
    </div>
    <div id="map"></div><br><br>
    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-23.5611, -46.6558),
          zoom: 10
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('resultado_mapa.php', function(data) {
            var xml = data.responseXML;
            var marcadores = xml.documentElement.getElementsByTagName('marcador');
            Array.prototype.forEach.call(marcadores, function(markerElem) {
              var name = markerElem.getAttribute('nome');
              var address = markerElem.getAttribute('endereco');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADbgZ9nYYiwZqEMJEJ79TZtziQdOrgJYQ&callback=initMap">
    </script>
</body>
</html>