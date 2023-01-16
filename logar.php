<?php
session_start();
include('./adm/conexao_bd/conexao.php');

if(isset($_POST["usuario"]) && isset($_POST["senha"])){
	$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
	$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

	$query = "SELECT * from Perfil where usuario = '$usuario' and senha = '$senha'";
	$result = mysqli_query($conexao, $query);
	$row = mysqli_num_rows($result);

	if($row == 1) {
		$usuario_bd = mysqli_fetch_assoc($result);
			
		if($usuario_bd['status'] == 0){
				header('Location: index_logado.php');
				$_SESSION['usuario'] = $usuario;
				exit();
			} 
			else if($usuario_bd['status'] == 1){
				header('Location: adm/index_administrador.php');
				$_SESSION['usuario'] = $usuario;
				exit();
			}
		} else {
			$_SESSION['nao_autenticado'] = true;
			header('Location: login.php');
			exit();
		}
	}else{
		header('Location: login.php');
		exit();
	}