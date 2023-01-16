<?php
session_start();
include('./adm/conexao_bd/conexao.php');

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Suporte</title>
	<link rel="stylesheet" type="text/css" href="style/suporte.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="imagex/png" href="./adm/Imagens/Imagens_index/logo.png">
</head>
<body>
	<div class="seta">
        <a href="index_logado.php"><img src="./adm/Imagens/Imagens_index/seta_voltar.png"></a>
    </div>
	<section class="cards">
		<div class="titulo">
			<h1>Suporte</h1>
		</div>
		<h3>Perguntas frequentes:</h3>
		<button class="accordion">Por que a Região Metropolitana de São Paulo?</button>
		<div class="resposta">
			<p>A Região Metropolitana de São Paulo foi escolhida, dado a sua grande reserva de pontos e atrações turísticas, eventos programáticos e principalmente por seu valor turístico-histórico que é outrora esquecido pelos próprios paulistas e paulistanos, sobretudo é trabalho do SampaPoint ajudar a divulgar estes pontos e explorar seu devido potencial.</p>
		</div>

		<button class="accordion">Por que está faltando alguns pontos turísticos?</button>
		<div class="resposta">
			<p>O SampaPoint primeiramente se ocupou a somente documentar os pontos turísticos mais relevantes, no entanto há aspiração de futuramente adicionar outras atrações turísticas, lembrando é claro que o site até então é somente uma amostra e rara demonstração do verdadeiro potencial que pode ser mais à frente.</p>
		</div>

		<button class="accordion">O meu perfil pode ser visualizado por outros usuários?</button>
		<div class="resposta">
			<p>Não, os outros usuários terão somente a acesso ao seu nome de usuário e foto de perfil escolhida, mas não está fora de cogitação uma possível opção de usuários acessarem perfis de outros usuários em breve, com é claro o aval de quem quer ter o perfil acessado.</p>
		</div>

		<button class="accordion">Somente o administrador terá acesso a minha localização?</button>
		<div class="resposta">
			<p>Sim, os seus dados como usuário cadastrado serão de conhecimento somente seu e do administrador para as aplicações dentro do site, em suma a sua privacidade é valorizada e respeitada.</p>
		</div>

		<button class="accordion">Há o intuito de expandir a atuação do SampaPoint para todo estado de São Paulo?</button>
		<div class="resposta">
			<p> Sim, maior que a relevância turística da Região Metropolitana de São Paulo, é o do seu respectivo estado de mesmo nome que suas respectivas histórias e cunho turístico que têm tanto a compartilhar com o interior paulista quanto a de ser um junção de elementos das culturas de outros estados que fazem divisa, sendo o Rio de Janeiro, Paraná, Mato Grosso e Minas Gerais, sendo por fim um valor turístico que não pode ser esquecido.</p>
		</div>

		<h3>Quer indicar um ponto? Envie seu email e entraremos em contato:</h3>
		<?php
			$sql = "SELECT * FROM perfil WHERE usuario = '$usuario'";
			$result2 = mysqli_query($conexao, $sql);
			    while($dado = $result2->fetch_array()){
		?>  
		<div class="form">
			<?php
            if(isset($_SESSION['enviado'])):
            ?>
                <h4 style="margin: 20px; color: red;">Email enviado!</h4>
            <?php
            endif;
            ?>
			<form action="suporte2.php" method="post" enctype="multipart/form-data">
				<div class="comentario">
					<input type='hidden' value="<?php echo $dado["codUsuario"]; ?>" name="usuario">
					<textarea name="email" type="email" rows='1' cols='80' style="resize: none;" maxlength="100" placeholder="Inserir Email" required><?php echo $dado["email"]; ?></textarea>
					<?php
					}
					?>
					<div class="botão">
						<button type="submit">Enviar</button>
					</div>
				</div>
			</form>
		</div>

		<script>
			var acc = document.getElementsByClassName("accordion");
			var i;

			for (i = 0; i < acc.length; i++) {
			acc[i].addEventListener("click", function() {
    			this.classList.toggle("active");
    		var panel = this.nextElementSibling;
    		if (panel.style.maxHeight) {
      			panel.style.maxHeight = null;
    		} else {
      		panel.style.maxHeight = panel.scrollHeight + "px";
    		} 
  			});
			}
		</script>
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