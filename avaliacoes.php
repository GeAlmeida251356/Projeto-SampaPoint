<?php
session_start();
include('./adm/conexao_bd/conexao.php');

//COLOCAR SEMPRE NO COMEÇO PARA NÃO CONSEGUIREM USAR O SITE SEM LOGIN//
if((!isset ($_SESSION['usuario']) == true))
{
  header('location:index.php');
} //ATÉ AQUI

$usuario = $_SESSION["usuario"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/ultavaliacao.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="imagex/png" href="./adm/Imagens/Imagens_index/logo.png">
    <title>Últimas Avaliações</title>
    <?php
    $sqlcomentarios = "SELECT * FROM avaliacao left JOIN perfil ON perfil.codUsuario = avaliacao.codUsuario left JOIN lugar ON lugar.codLocal = avaliacao.codLocal WHERE perfil.usuario = '$usuario' ORDER BY avaliacao.dataPostagem desc";
    ?>
</head>
<body style="
     background-image: url(./adm/Imagens/Imagens_index/fundo4_logado.jpg);
     background-size: cover;
     background-repeat: no-repeat;
     background-attachment: fixed;
     background-position: center;">
    <div class="seta">
        <a href="meuperfil.php"><img src="./adm/Imagens/Imagens_index/seta_voltar.png"></a>
    </div>
    <section class="container2" style="margin-top: 0;"> <!-- style = "background-color: #333333;"> -->            
        <div>
            <h1>Últimas avaliações:</h1>
        </div>
            <?php
			    $result = mysqli_query($conexao, $sqlcomentarios);
			    while($dado = $result->fetch_array()){
			?>
			<div class="card2">
                    <?php $codLocal  = base64_encode($dado['codLocal']);?>
                    <p>Comentado em: <?php echo $dado["dataPostagem"]; ?><br>
					Nome: <?php echo $dado["usuario"]; ?><br>
					Nota: <?php echo $dado["notaEstrela"]; ?><br>
                    Lugar: <?php echo $dado["nomeLocal"]; ?><br>
                    <textarea name="comentario" type="text" rows='3' cols='200' style="resize: none;" maxlength="200" readonly><?php echo $dado["comentario"]; ?></textarea>
                    <?php 
                    if (empty($dado['nomeFotoAvaliacao'])){
                        $imagem = 'semImg.gif';
                    }else{
                        $imagem = $dado['nomeFotoAvaliacao'];
                    }
                    echo "<img src='./adm/Imagens/imagens_avaliacao/$imagem' width='300' height='300'>";
                    ?></p>
                    <div class="botão">
                        <?php print "<button style='margin-left: 0; width: 100%;'><a href='verlugar.php?codLocal=$codLocal'>Ver Lugar</a></button>";?>
                        <form action="apagarcomentario.php" method="post">
                            <input name="id" type="hidden" value="<?php echo $dado["codAvaliacao"]; ?>">
                            <button type = "submit" style="margin-left: 0; width: 100%;">Apagar Comentário</button>
                        </form>
                    </div>
			</div>
			<?php
			}
			?>
	
	</section>

</body>
</html>