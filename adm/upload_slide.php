<?php
	include_once('./conexao_bd/conexao.php');
	
    $codigo = mysqli_real_escape_string($conexao, trim($_POST['codigo']));
    $dir = './Imagens/imagens_slide_lugar/';

		if(!is_dir($dir)){
			echo "Pasta $dir nao existe";
		} else {
			$arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;
			$name = $_FILES['arquivo']['name'];
			$tmpName = $_FILES['arquivo']['tmp_name']; 
			for ($controle = 0; $controle < count($name); $controle++){
				$extensao = explode('.', $name[$controle]);
				$extensao = end($extensao);
				$destino = $dir."/".$name[$controle];


				if(move_uploaded_file($tmpName[$controle], $destino)){
					$sqlupdate =  "INSERT INTO fotos_lugar (codLocal, nomeFotoLugar) VALUES ('$codigo','$name[$controle]')";
					// executando instru��o SQL atrav�s do m�todo sqlstring()
                    $result = mysqli_query($conexao, $sqlupdate);
				} else {		
				// direciona para a p�gina de erro qdo ocorre erro no move_uploaded_file
				header('Location: erro.php'); 			
				}
			}header('Location: index_administrador.php');
		}
?>
