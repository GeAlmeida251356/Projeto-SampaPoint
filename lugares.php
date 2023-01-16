<?php
session_start();
include('./adm/conexao_bd/conexao.php');

//COLOCAR SEMPRE NO COMEÇO PARA NÃO CONSEGUIREM USAR O SITE SEM LOGIN//
if((!isset ($_SESSION['usuario']) == true))
{
  header('location:index.php');
} //ATÉ AQUI


if(!empty($_GET['search']))
{
  $data = $_GET['search'];
  $consulta = "SELECT * FROM lugar WHERE lugar.codLocal LIKE '%$data%' or lugar.nomeLocal LIKE '%$data%' or lugar.cidadeLugar LIKE '%$data%' ORDER BY nomeLocal";
  //FAZER SELECT DAS TABELAS "Lugar" E "FotosLugar"
}
else
{
  $consulta = "SELECT * FROM lugar ORDER BY codLocal";
}
$result = mysqli_query($conexao, $consulta);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/lugares.css">
    <link rel="shortcut icon" type="imagex/png" href="./adm/Imagens/Imagens_index/logo.png">
    <title>SampaPoint</title>
</head>
<body>
    <header>
	<section class="header">
		<nav>
            <div class="seta">
                <a href="index_logado.php"><img src="./adm/Imagens/Imagens_index/seta_voltar.png"></a>
            </div>			
		</nav>

		<div class="search-box">
            <input class="search-txt" type="text" name="" placeholder="Pesquisar" id="pesquisar">
            <button class="search-btn" onclick="searchData()">
                <i class="fas fa-search"></i>
            </button>		
        </div>
	</section>
    </header>

    <div class="container">
        <?php
            while($dado = $result->fetch_array()){  
                $codigo = $dado['codLocal'];
        ?>
        <div class="card card-1">
        <div class="card-header">
          <?php 
                if (empty($dado['fotoPerfilLugar'])){
                    $imagem = 'selecionarimg.png';
                }else{
                    $imagem = $dado['fotoPerfilLugar'];
                    }
                echo "<img src='./adm/Imagens/imagens_perfil_lugar/$imagem' class='card-img'>";
                ?>
        </div>
        <div class="card-body">
          <h3 class="card-local"><?php echo $dado["cidadeLugar"]; ?></h3>
          <h2 class="card-titulo"><?php echo $dado["nomeLocal"]; ?></h2>
          <!--<?php 
          $sqlmedia = "SELECT ROUND (AVG(notaEstrela), 2) AS mediaAvaliacao  FROM avaliacao WHERE codLocal = $codigo";
			$result2 = mysqli_query($conexao, $sqlmedia);
			    while($dado2 = $result2->fetch_array()){
			?>  
			<p>Nota: <?php echo $dado2['mediaAvaliacao']; } ?></p>-->
        </div>
        <div class="card-footer">
            <?php
                $codLocal  = base64_encode($dado['codLocal']);
                echo "<a href='verlugar.php?codLocal=$codLocal'>Ver mais</a>";
            ?>
        </div>
      </div>
        <?php 
        }
        ?>
        </div>

</body>
<?php
?>
<script>
  var search = document.getElementById('pesquisar');

  search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'lugares.php?search='+search.value;
    }
</script>
</html>