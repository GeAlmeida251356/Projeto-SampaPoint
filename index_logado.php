<?php
include('verifica_login.php');

//COLOCAR SEMPRE NO COMEÇO PARA NÃO CONSEGUIREM USAR O SITE SEM LOGIN//
if((!isset ($_SESSION['usuario']) == true))
{
  header('location:index.php');
} //ATÉ AQUI
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SampaPoint</title>
	<link rel="stylesheet" type="text/css" href="style/index.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="imagex/png" href="./adm/Imagens/Imagens_index/logo.png">
</head>
<body>
	<div class="banner">
		<div class="titulo">
			<h1>Bem vindo, <?php echo $_SESSION['usuario'];?>!</h1>
			<div>
                <a href="meuperfil.php"><button type="button"><span></span>Meu Perfil</button></a>
                <a href="lugares.php"><button type="button"><span></span>Ver Lugares</button></a>
                <a href="index_mapa.php"><button type="button"><span></span>Mapa Geral</button></a>
                <a href="suporte.php"><button type="button"><span></span>Suporte</button></a>
                <a href="./logout.php"><button type="button"><span></span>Sair</button></a>
			</div>		
		</div>
		<ul class="socials">
				<li><a href="https://www.instagram.com/sampapoint262/" target="_blank"><i class="fa fa-instagram"></i></a></li>
				<li><a href="https://www.youtube.com/channel/UCYfI1mO3LFTu30JInTLnxEg" target="_blank"><i class="fa fa-youtube"></i></a></li>
				<li><a href="mailto:sppoint262@gmail.com?subject=SampaPoint" target="_blank"><i class="fa fa-google"></i></a></li>		
			</ul>
	</div>
</body>
</html>
