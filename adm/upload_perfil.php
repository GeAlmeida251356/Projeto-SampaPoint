<?php
	include_once('./conexao_bd/conexao.php');

    $codigo = mysqli_real_escape_string($conexao, trim($_POST['codigo']));
	if( $_FILES['arquivo'] ) { 
		$dir = './Imagens/imagens_perfil_lugar/'; 
	
		$tmpName = $_FILES['arquivo']['tmp_name']; 
		$name = $_FILES['arquivo']['name']; 
		
		// move_uploaded_file
		if( move_uploaded_file( $tmpName, $dir . $name ) ) { 	
				$sqlupdate =  "UPDATE lugar SET fotoPerfilLugar = '$name' WHERE codLocal = $codigo";
				// executando instru��o SQL atrav�s do m�todo sqlstring()
                $result = mysqli_query($conexao, $sqlupdate);
				 header('location: index_administrador.php');
		} else {		
			// direciona para a p�gina de erro qdo ocorre erro no move_uploaded_file
			header('Location: erro.php'); 			
		}
		
	} else {
		// direciona para a p�gina de erro qdo n�o seleciona o arquivo
		header('Location: erro.php'); 
	}
?>


