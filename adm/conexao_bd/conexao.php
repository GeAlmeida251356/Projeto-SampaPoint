<?php
header("Content-type: text/html; charset=utf-8");
define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'sampapoint');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');
?>


