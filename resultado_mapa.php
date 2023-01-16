<?php
require("./adm/conexao_bd/conexao.php");

$resultado_marcadores = "SELECT * FROM lugar ";
$result = mysqli_query($conexao, $resultado_marcadores);

header("Content-type: text/xml");

echo '<marcadores>';

while ($dado = mysqli_fetch_assoc($result)){

  echo '<marcador ';
  echo 'nome="' . $dado['nomeLocal'] . '" ';
  echo 'endereco="' . $dado['ruaLugar'] . ' ' . $dado['numeroLugar'] . ' - '. $dado['bairroLugar'] . ', ' . $dado['cidadeLugar']. ' - ' . $dado['cepLugar'] . '" ';
  echo 'lat="' . $dado['latLugar'] . '" ';
  echo 'lng="' . $dado['lngLugar'] . '" ';
  echo '/>';
}

// End XML file
echo '</marcadores>';



