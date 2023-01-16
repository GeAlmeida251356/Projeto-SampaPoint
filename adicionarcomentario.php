<?php
session_start();
include('./adm/conexao_bd/conexao.php');

if(!empty($_POST['estrela'])){
	$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
	$codLocal = mysqli_real_escape_string($conexao, trim($_POST['codigo']));
	$comentario = mysqli_real_escape_string($conexao, trim($_POST['comentario']));
	$estrela = $_POST['estrela'];
	
	//Salvar no banco de dados
	$result_avaliacos = "INSERT INTO Avaliacao (codUsuario, codLocal, comentario, notaEstrela, dataPostagem, nomeFotoAvaliacao) VALUES ($usuario, '$codLocal', '$comentario', $estrela, NOW(), NULL);";
    $result = mysqli_query($conexao, $result_avaliacos);

	$sqlcodusuario = "SELECT * FROM Avaliacao WHERE codUsuario = '$usuario' AND codLocal = '$codLocal' AND comentario = '$comentario' AND notaEstrela = '$estrela'";
	$result = mysqli_query($conexao, $sqlcodusuario);
	while($dado = $result->fetch_array()){
	$id = $dado['codAvaliacao'];	
	}

	if( $_FILES['arquivo'] ) {
		$dir = './adm/Imagens/imagens_avaliacao/';
	
	   $tmpName = $_FILES['arquivo']['tmp_name'];
		$name = $_FILES['arquivo']['name'];
		if( move_uploaded_file( $tmpName, $dir . $name ) ) {     
			$sql = "UPDATE Avaliacao SET nomeFotoAvaliacao = '$name' WHERE codAvaliacao = '$id'";
			$result = mysqli_query($conexao, $sql);
		}
	}
	
	if($conexao == TRUE){
		$_SESSION['msg'] = "Avaliação cadastrada com sucesso";
		header("Location: verlugar.php?codLocal=$codLocal");
	}else{
		$_SESSION['msg'] = "Erro ao cadastrar a avaliação";
		header("Location: verlugar.php?codLocal=$codLocal");
	}
	
}else{
	$_SESSION['msg'] = "Necessário selecionar pelo menos 1 estrela";
	header("Location: verlugar.php?codLocal=$codLocal");
}

