<?php
session_start();
include('./adm/conexao_bd/conexao.php');

//COLOCAR SELECT DAS TABELAS USUARIO E FOTOS_USUARIO
$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));

if ($_FILES['arquivo']){
    $dir = './adm/Imagens/imagens_perfil_usuario/';

    $tmpName = $_FILES['arquivo']['tmp_name'];
    $name = $_FILES['arquivo']['name'];
        if( move_uploaded_file( $tmpName, $dir . $name ) ) {
            $sql2 = "UPDATE Perfil SET nomeFotoPerfil = '$name' WHERE usuario = '$usuario'";
            $result2 = mysqli_query($conexao, $sql2);
        }
}

if($conexao->query($sql2) === TRUE){
    $_SESSION['update_cadastro'] = true;
    header('Location: editarperfil_foto.php');
};
?>