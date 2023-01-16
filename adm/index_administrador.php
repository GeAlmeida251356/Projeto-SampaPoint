<?php
include('../verifica_login.php');

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
	<title>Administrador</title>
	<link rel="stylesheet" type="text/css" href="../style/index.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="imagex/png" href="../adm/Imagens/Imagens_index/logo.png">
</head>
<body>
	<div class="banner">
		<div class="titulo">
			<h1>Bem vindo, Administrador!</h1>
			<div>
        <a href="inclusao.php"><button type="button"><span></span>Incluir</button></a>
        <a href="alteracao.php"><button type="button"><span></span>Alterar</button></a>
        <a href="imagem_perfil.php"><button type="button"><span></span>Incluir Imagem de Perfil</button></a>
        <a href="imagem_slide.php"><button type="button"><span></span>Incluir Imagens</button></a>
        <a href="../logout.php"><button type="button"><span></span>Sair</button></a>
			</div>		
		</div>
	</div>
</body>
</html>
