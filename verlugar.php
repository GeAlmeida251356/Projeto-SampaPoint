<?php
session_start();
include('./adm/conexao_bd/conexao.php');

//COLOCAR SEMPRE NO COMEÇO PARA NÃO CONSEGUIREM USAR O SITE SEM LOGIN//
if((!isset ($_SESSION['usuario']) == true))
{
  header('location:index.php');
} //ATÉ AQUI


if(isset($_GET['codLocal']) && is_numeric(base64_decode($_GET['codLocal']))){
    $codLocal = base64_decode($_GET['codLocal']);
}else{
    header('location: lugares.php');
}
$usuario = $_SESSION['usuario'];
$sqlconsulta = "SELECT * FROM lugar WHERE codLocal = $codLocal";

$result = mysqli_query($conexao, $sqlconsulta);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="style/verlugar.css">
    <link rel="shortcut icon" type="imagex/png" href="./adm/Imagens/Imagens_index/logo.png">
    <?php
    while($dado = $result->fetch_array()){  
    ?>
    <title><?php echo $dado["nomeLocal"]; ?></title>

</head>
<body>
    <div class="seta">
        <a href="lugares.php"><img class = "seta" src="./adm/Imagens/Imagens_index/seta_voltar.png"></a>
    </div>

	<div class="container">
		<?php
			$result_carousels = "SELECT * FROM fotos_lugar WHERE codLocal = $codLocal";
			$resultado_carousels = mysqli_query($conexao, $result_carousels);
			if(($resultado_carousels) AND ($resultado_carousels->num_rows != 0)){
		?>
		<div class="slide">
			<div class="recurso de linha">
				<div class="coluna">					
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<?php
								$qnt_slide = mysqli_num_rows($resultado_carousels);
								$cont_marc = 0;
								while($cont_marc < $qnt_slide){
								echo "<li codFotosLocal='valor-car' data-target='#myCarousel' data-slide-to='$cont_marc'></li>";
								$cont_marc++;
								}
							?>
						</ol>
						<div class="carousel-inner">
							<?php
								$cont_slide = 0;
								while( $row_slide = mysqli_fetch_assoc($resultado_carousels)){
								$active = "";
									if($cont_slide == 0){
										$active = "active";
									}
									echo "<div class='carousel-item $active'>";
									echo "<img class='d-block' src='./adm/Imagens/imagens_slide_lugar/".$row_slide['nomeFotoLugar']."'>";
									echo "</div>";
									$cont_slide++;
								}
							?>
						</div>
						<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Anterior</span>
						</a>
						<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Próximo</span>
						</a>
					</div>	
				</div>
			</div>
		</div>
		<div class="infos">
			<h2><?php echo $dado["nomeLocal"]; ?></h2>
			<P>Horário: <?php echo $dado["horarioLocal"]; ?></P>
			<P>Preço: <?php echo $dado["precoLocal"]; ?></P>
			<P>Endereço: <?php echo $dado["cepLugar"]; ?>, <?php echo $dado["ruaLugar"]; ?>, Bairro: <?php echo $dado["bairroLugar"]; ?>, <?php echo $dado["cidadeLugar"]; ?> <?php echo $dado["numeroLugar"]; ?></P>
			<?php
			$sqlmedia = "SELECT ROUND (AVG(notaEstrela), 2) AS mediaAvaliacao  FROM avaliacao WHERE codLocal = $codLocal";
			$result2 = mysqli_query($conexao, $sqlmedia);
			    while($dado2 = $result2->fetch_array()){
			?>  
			<h2>Nota: <?php echo $dado2['mediaAvaliacao']; } ?></h2>
		</div>
		<?php 
			} 
		?>
	</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	
	<section class="container">
			<div class="card">
				<h4 style="margin: 0 auto; color: whitesmoke;">Descrição:</h4>
				<p><?php echo $dado["descLugar"];?></p>
			</div>
			<div class="mapa">
				<img class = "mapa" src="https://maps.geoapify.com/v1/staticmap?style=osm-carto&width=600&height=400&center=lonlat:<?php echo $dado["lngLugar"]; ?>,<?php echo $dado["latLugar"]; ?>&zoom=14&marker=lonlat:<?php echo $dado["lngLugar"]; ?>,<?php echo $dado["latLugar"]; ?>;type:material;color:%23ff3421;icontype:awesome&apiKey=2a2d933fa9594003b260c15009ed0498">
			</div>
	</section>

	<section class="container2"> <!-- style = "background-color: #333333;"> -->
			<form action="adicionarcomentario.php" onchange="previewImagem()" method="post" enctype="multipart/form-data">
				<div>
					<h1>Avaliações:</h1>
				</div>
				<div>
					<?php
					$sqlcodusuario = "SELECT * FROM perfil WHERE usuario = '$usuario'";
						$result = mysqli_query($conexao, $sqlcodusuario);
						while($dado = $result->fetch_array()){
					?>
					<input type='hidden' value="<?php echo $dado["codUsuario"]; ?>" name="usuario">
					<?php
						}
					?>
					<input type='hidden' value="<?php echo $codLocal; ?>" name="codigo">
					<?php 
						}
							if(isset($_SESSION['msg'])){
								echo $_SESSION['msg'];
								unset($_SESSION['msg']);
							}
						?>
				</div>
				
				<div class="caixa">
					<div class="comentario">
						<textarea name="comentario" type="text" rows='3' cols='200' style="resize: none;" maxlength="200" placeholder="Comentar"></textarea>
					</div>
					<div class="foto">
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
						<label for="arquivo" class="labelInput">Enviar foto:
                            <input type="file" name="arquivo" id="arquivo"><br><img src="./adm/Imagens/Imagens_index/selecionarimg.png" class= "avali" style="margin: 10px; width: 350px; height: 350px;">
                        </label>
					</div>

						<div class="estrelas">
						<input type="radio" id="vazio" name="estrela" value="" checked>
						
						<label for="estrela_um"><i class="fa"></i></label>
						<input type="radio" id="estrela_um" name="estrela" value="1">
						
						<label for="estrela_dois"><i class="fa"></i></label>
						<input type="radio" id="estrela_dois" name="estrela" value="2">
						
						<label for="estrela_tres"><i class="fa"></i></label>
						<input type="radio" id="estrela_tres" name="estrela" value="3">
						
						<label for="estrela_quatro"><i class="fa"></i></label>
						<input type="radio" id="estrela_quatro" name="estrela" value="4.0">
						
						<label for="estrela_cinco"><i class="fa"></i></label>
						<input type="radio" id="estrela_cinco" name="estrela" value="5">
						</div>

						<div class="botão">
							<button type="submit">Comentar</button>
						</div>
				</div>
			</form>

			<?php
			$sqlcomentarios = "SELECT * FROM avaliacao left JOIN perfil ON perfil.codUsuario = avaliacao.codUsuario left JOIN lugar ON lugar.codLocal = avaliacao.codLocal WHERE lugar.codLocal = $codLocal ORDER BY avaliacao.dataPostagem desc";

			$result = mysqli_query($conexao, $sqlcomentarios);
			while($dado = $result->fetch_array()){
			?>
			<div class="card2">
					<p><h5> Comentado em: <?php echo $dado["dataPostagem"]; ?></h5><br>
					<h6>Nome: <?php echo $dado["usuario"]; ?></h6><br>
					<h6>Nota: <?php echo $dado["notaEstrela"]; ?></h6><br>
					<div>
						<textarea name="comentario" type="text" rows='3' cols='200' style="resize: none;" maxlength="200" readonly><?php echo $dado["comentario"]; ?></textarea>
						<?php 
							if (empty($dado['nomeFotoAvaliacao'])){
								$imagem = 'semImg.gif';
							}else{
								$imagem = $dado['nomeFotoAvaliacao'];
							}
							echo "<img src='./adm/Imagens/imagens_avaliacao/$imagem' width='300' height='300'>";
                    	?>
					</div></p>
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
<script>
			$(document).ready(function () {
				//tempo de duração do slide
				$('.carousel').carousel({
					interval: 7000
				});
				
				$('#myCarousel').on('slid.bs.carousel', function () {
					//Receber o valor do atributo data-slide-to quando estiver ativo
					var numeroSlide = $('#valor-car.active').data('slide-to');
					//$("#msg").html(numeroSlide);
					
					//Ocultar a descrição do slide anterior
					$('.conteudo').hide();
					
					//Apresentar o conteúdo do slide atual
					$('.imagem' + numeroSlide).show();
				});
			});			
		</script>