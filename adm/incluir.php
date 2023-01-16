	<?php
		include_once('./conexao_bd/conexao.php');
 
        $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
        $horario = mysqli_real_escape_string($conexao, trim($_POST['hora']));
        $valor = mysqli_real_escape_string($conexao, trim($_POST['valor']));
        $cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));
        $rua = mysqli_real_escape_string($conexao, trim($_POST['rua']));
        $bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
        $cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
        $numcasa = mysqli_real_escape_string($conexao, trim($_POST['numcasa']));
        $descricao = mysqli_real_escape_string($conexao, trim($_POST['descricao']));
        $latitude = mysqli_real_escape_string($conexao, trim($_POST['lat']));
        $longitude = mysqli_real_escape_string($conexao, trim($_POST['lng']));

		// criando a linha de INSERT
		$sqlinsert =  "insert into Lugar (nomeLocal, horarioLocal, precoLocal, cepLugar, ruaLugar, bairroLugar, cidadeLugar, numeroLugar, descLugar, latLugar, lngLugar, fotoPerfilLugar) values ('$nome', '$horario', '$valor', '$cep', '$rua', '$bairro', '$cidade', '$numcasa', '$descricao', $latitude, $longitude, 'NULL')";
		
        $result = mysqli_query($conexao, $sqlinsert);
		header('Location: index_administrador.php');

	?>

