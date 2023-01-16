<?php
session_start();
include('../adm/conexao_bd/conexao.php');

//COLOCAR SEMPRE NO COMEÇO PARA NÃO CONSEGUIREM USAR O SITE SEM LOGIN//
if((!isset ($_SESSION['usuario']) == true))
{
  header('location: ../index.php');
} //ATÉ AQUI
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/cadastro.css">
    <link rel="shortcut icon" type="imagex/png" href="../adm/Imagens/Imagens_index/logo.png">
    <title>Imagem de slide do lugar</title>
</head>
<body>
<section class="container" style="top: 50%; left: 50%;">
        <body class="bg-dark">
            <div class="row">
                <div class="col p-1">
                    <label><strong>Incluir imagem de slides</strong></label>
                </div>
            </div>
            <div class="row">
                <form action="consultarimg_slide.php" onchange="previewImagem()" method="post" enctype="multipart/form-data">
                <div class="col-12 mb-3">
                    <input name="codigo" type="text" placeholder="Código do Lugar" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="shadow">Incluir</button>
                </div>
                </form>
                <div class="col">    
                    <button onclick="window.location='index_administrador.php';" value="Voltar">Voltar</button>  
                </div>
            </div>
        </div>
    </section>   
</body>
</html>
