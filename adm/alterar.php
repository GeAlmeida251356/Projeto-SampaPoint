<?php
	include_once('./conexao_bd/conexao.php');

    $codigo = mysqli_real_escape_string($conexao, trim($_POST['codigo']));
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $horario= mysqli_real_escape_string($conexao, trim($_POST['hora']));
    $valor = mysqli_real_escape_string($conexao, trim($_POST['valor']));
    $cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));
    $rua = mysqli_real_escape_string($conexao, trim($_POST['rua']));
    $bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
    $cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
    $numcasa = mysqli_real_escape_string($conexao, trim($_POST['numcasa']));
    $desc = mysqli_real_escape_string($conexao, trim($_POST['descricao']));
    $lat = mysqli_real_escape_string($conexao, trim($_POST['lat']));
    $lng = mysqli_real_escape_string($conexao, trim($_POST['lng']));

	// criando a linha do  UPDATE
	$sqlupdate =  "UPDATE lugar set nomeLocal='$nome', horarioLocal='$horario', precoLocal='$valor', cepLugar='$cep', ruaLugar='$rua', bairroLugar='$bairro', cidadeLugar='$cidade', numeroLugar='$numcasa', descLugar='$desc', latLugar='$lat', lngLugar='$lng' WHERE codLocal = $codigo";

	// executando instrução SQL através do método sqlstring()
    $result = mysqli_query($conexao, $sqlupdate);
    header('Location: index_administrador.php');

    ?>

