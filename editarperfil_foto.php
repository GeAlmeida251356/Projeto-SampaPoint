<?php
session_start();
include('./adm/conexao_bd/conexao.php');

$usuario = $_SESSION["usuario"];
$consulta = "SELECT * FROM Perfil WHERE usuario = '$usuario'";
$result = mysqli_query($conexao, $consulta);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="imagex/png" href="./adm/Imagens/Imagens_index/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style/editarperfil_foto.css">
    <title>Editar Foto</title>

    <script type="text/javascript">
    function previewImagem(){
            var imagem = document.querySelector ('input[name=arquivo]').files[0];
            var preview = document.querySelector ('img[class=avali]');
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
    <div class="seta">
        <a href="meuperfil.php"><img src="./adm/Imagens/Imagens_index/seta_voltar.png"></a>
    </div>
    <section class="container">
    <?php
        if(isset($_SESSION['update_cadastro'])):
            ?>
            <div class="alerta">    
                <h3>Alteração concluída!</h3>
                <h4><a href="meuperfil.php">Clique aqui para Voltar</a></h4>
            </div>
            <?php
            endif;
            unset($_SESSION['update_cadastro']);
        while($dado = $result->fetch_array()){
            ?>
        <body class="bg-dark">
						<div class="row">
							<div class="col p-1">
								<label><strong>Editar foto de perfil</strong></label>
							</div>
						</div>
							<div class="row">
                                <form action="editarperfil_foto2.php" onchange="previewImagem()" method="post" enctype="multipart/form-data">
                                <div class="col-12 mb-3">
                                    <input name="usuario" type="hidden" value="<?php echo $usuario;?>" readonly placeholder="Nome de usuário">
                                </div>
                                <div class="col-12 mb-3">
                                <label for="arquivo" class="labelInput">Enviar foto de perfil:
                                    <input type="file" name="arquivo" id="arquivo" required><br><img src="./adm/Imagens/Imagens_index/selecionarimg.png" class="avali" style="margin: 10px; width: 350px; height: 350px;">
                                </label>
                                </div>
                            </div>    
						    <div class="row">
							<div class="col">
								<button type="submit" class="shadow">Alterar</button>
						    </div>
                            </div>
						    </form>
        </section>
        <?php
        }
        ?>
        <footer>
		<div class="footer-bottom">
			<div class="redes">
				<p>Acesse nossas redes:</p>
			</div>
			<ul class="socials">
			<li><a href="https://www.instagram.com/sampapoint262/" target="_blank"><i class="fa fa-instagram"></i></a></li>
			<li><a href="https://www.youtube.com/channel/UCYfI1mO3LFTu30JInTLnxEg" target="_blank"><i class="fa fa-youtube"></i></a></li>
			<li><a href="mailto:sppoint262@gmail.com?subject=SampaPoint" target="_blank"><i class="fa fa-google"></i></a></li>
			</ul>
			<div class="copyright">
				<p>copyright &copy;2022. Feito por: <span>Asafe, Geovane, Marco</span></p>
			</div>
		</div>
	</footer>  
</body>
</html>