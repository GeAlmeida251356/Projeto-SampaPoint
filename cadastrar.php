<?php
session_start();
include("./adm/conexao_bd/conexao.php");

$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));
$rua = mysqli_real_escape_string($conexao, trim($_POST['rua']));
$bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
$cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
$uf = mysqli_real_escape_string($conexao, trim($_POST['uf']));
$numcasa = mysqli_real_escape_string($conexao, trim($_POST['numcasa']));
$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
$bio = mysqli_real_escape_string($conexao, $_POST['bio']);



if( $_FILES['arquivo'] ) {
    $dir = './adm/Imagens/imagens_perfil_usuario/';



   $tmpName = $_FILES['arquivo']['tmp_name'];
    $name = $_FILES['arquivo']['name'];
    if( move_uploaded_file( $tmpName, $dir . $name ) ) {     
        $sql = "select count(*) as total from Perfil where usuario = '$usuario'";
        $result = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $sql2 = "INSERT INTO Perfil (status, nome, email, cepUsuario, ruaUsuario, bairroUsuario, cidadeUsuario, estadoUsuario, numCasaUsuario, usuario, senha, biografia, nomeFotoPerfil)
        VALUES
        (0, '$nome', '$email', '$cep', '$rua', '$bairro', '$cidade', '$uf', $numcasa, '$usuario', '$senha', '$bio', '$name')";

       if($row["total"] == 1) {
            $_SESSION['usuario_existe'] = true;
            header('Location: cadastro.php');
            exit();
            $conexao->close();
        }
        else if($conexao->query($sql2) === TRUE) {
            header('Location: index_logado.php');
            $_SESSION['usuario'] = $usuario;
            exit();
        }

    }
}

?>