<?php
session_start();
include('./adm/conexao_bd/conexao.php');

//COLOCAR SELECT DAS TABELAS USUARIO E FOTOS_USUARIO
$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
$cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));
$rua = mysqli_real_escape_string($conexao, trim($_POST['rua']));
$bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
$cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
$uf = mysqli_real_escape_string($conexao, trim($_POST['uf']));
$numcasa = mysqli_real_escape_string($conexao, trim($_POST['numcasa']));
$bio = mysqli_real_escape_string($conexao, $_POST['bio']);

$sql = "UPDATE Perfil SET nome = '$nome', email = '$email', senha = '$senha', cepUsuario = '$cep', 
ruaUsuario = '$rua', bairroUsuario = '$bairro', cidadeUsuario = '$cidade', estadoUsuario = '$uf', numCasaUsuario = '$numcasa', 
biografia = '$bio' WHERE usuario = '$usuario'";
$result = mysqli_query($conexao, $sql);
$_SESSION['update_cadastro'] = true;
header('Location: editarperfil.php');
?>