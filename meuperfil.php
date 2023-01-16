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
    <link rel="stylesheet" type="text/css" href="style/meuperfil.css"> 
    <title><?php echo $_SESSION["usuario"];?></title>
</head>
<body>
    <div class="seta">
        <a href="index_logado.php"><img src="./adm/Imagens/Imagens_index/seta_voltar.png"></a>
    </div>
    <section class="container">
    <?php
            if(isset($_SESSION['usuario_existe'])):
            ?>
                <div class="erro">
                    <p>O usuário escolhido já existe.</p>
                </div>
            <?php
            endif;
            unset($_SESSION['usuario_existe']);
            ?>
        <body class="bg-dark">
            <?php
                while($dado = $result->fetch_array()){  
            ?>
						<div class="row">
							<div class="col p-1">
                                <label for="arquivo" class="">
                                    <?php 
                                        if (empty($dado['nomeFotoPerfil'])){
                                            $imagem = 'src="selecionarimg.png';
                                        }else{
                                            $imagem = $dado['nomeFotoPerfil'];
                                            }
                                        echo "<img src='./adm/Imagens/imagens_perfil_usuario/$imagem' width='300' height='300'>";
                                    ?>
                                </label>
							</div>
						</div>
							<div class="row">
                                <div class="col-12 mb-3">
                                    <input type="nome" type="text" value="<?php echo $dado["nome"]; ?>" placeholder="Nome Completo" readonly required>
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="email" type="email" value="<?php echo $dado["email"]; ?>" placeholder="Email" readonly required>
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="usuario" type="text" value="<?php echo $dado["usuario"];?>" placeholder="Nome de usuário" readonly required>
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea name="bio" type="text" value="" rows='6' cols='200' style="resize: none;" placeholder="Biografia" readonly><?php echo $dado['biografia'];?></textarea>
                                </div>
                            </div>    
						    <div class="row">
						    <div class="col">    
                                <button onclick="window.location='editarperfil.php';" value="Editar">Editar Perfil</button>
						        <button onclick="window.location='editarperfil_foto.php';" value="Voltar">Editar Foto</button>  
                                <button onclick="window.location='avaliacoes.php';" value="Editar">Últimas avaliações</button>
                            </div>
                            </div>
                        <?php
                        }
                        ?>
        </section>
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