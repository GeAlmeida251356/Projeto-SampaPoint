<?php
session_start();
include("./adm/conexao_bd/conexao.php");

$id = mysqli_real_escape_string($conexao, trim($_POST['id']));

$sql = "DELETE FROM avaliacao WHERE codAvaliacao = $id";
$result = mysqli_query($conexao, $sql);

if ($conexao == TRUE){
    header('Location: avaliacoes.php');
} else {
    header('Location: index_logado.php');
}
