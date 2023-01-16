<?php
session_start();
include('../adm/conexao_bd/conexao.php');

//COLOCAR SEMPRE NO COMEÇO PARA NÃO CONSEGUIREM USAR O SITE SEM LOGIN//
if((!isset ($_SESSION['usuario']) == true))
{
  header('location: ../index.php');
} //ATÉ AQUI
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../style/cadastro.css">
	<link rel="shortcut icon" type="imagex/png" href="../adm/Imagens/Imagens_index/logo.png">
	<title>Imagem de perfil do lugar</title>
	<script>
	    function previewImagem(){
            var imagem = document.querySelector ('input[name=arquivo]').files[0];
            var preview = document.querySelector ('img');
            var reader = new FileReader();
            reader.onloadend = function(){
                preview.src = reader.result
            }

            if(imagem){
                reader.readAsDataURL(imagem);
            }else{
                preview.src = "";
            }
        }
    </script>
</head>
<body>
	<?php
		include_once('./conexao_bd/conexao.php');
		
		// recuperando 
        $codigo = mysqli_real_escape_string($conexao, trim($_POST['codigo']));

		// criando a linha do  SELECT
		$sqlconsulta =  "SELECT * FROM lugar WHERE codLocal = $codigo";
		
		$result = mysqli_query($conexao, $sqlconsulta);
        while($dado = $result->fetch_array()){  

		
	?>
    
<section class="container" style="top: 50%;">
        <body class="bg-dark">
						<div class="row">
							<div class="col p-1">
								<label><strong>Incluir</strong></label>
							</div>
						</div>
							<div class="row">
                                <form action="upload_perfil.php" onchange="previewImagem()" method="post" enctype="multipart/form-data">
								<div class="col-12 mb-3">
                                    <input type="number" value="<?php echo $dado['codLocal']; ?>" readonly >
                                </div>

								<div class="col-12 mb-3">
                                <label for="arquivo" class="labelInput">Enviar Imagem:
                                    <input type="file" name="arquivo" id="arquivo" required><br>
									<?php 
									if (empty($dado['fotoPerfilLugar'])){
										$imagem = 'selecionarimg.png';
									}else{
										$imagem = $dado['fotoPerfilLugar'];
										}
									echo "<img src='./Imagens/imagens_perfil_lugar/$imagem' style='margin: 5px; width: 300px; height: 300px;'>";
									}
									?>
								</label>
                                </div>
								<div class="col-12 mb-3">
                                    <input name="codigo" type="hidden" value="<?php echo $codigo; ?>">
                                </div>
                            </div>    
						    <div class="row">
							<div class="col">
								<button type="submit" class="shadow">Incluir</button>
						    </div>
						    </form>
						    <div class="col">    
						        <button onclick="window.location='imagem_perfil.php';" value="Voltar">Voltar</button>  
						    </div>
                            </div>
        </section>
</body>
</html>

