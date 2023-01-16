<?php
session_start();
include("./adm/conexao_bd/conexao.php");

$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));

$sql = "INSERT INTO suporte (codUsuario, email, statusEmail) VALUES ($usuario,'$email','NÃO RESPONDIDO')";
$result = mysqli_query($conexao, $sql);

if ($conexao == TRUE){
    $_SESSION['enviado'] = true;
    header('Location: suporte.php');
}