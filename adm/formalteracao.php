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
	<title>Alterar Lugar</title>
</head>
<body>
	<?php
		include_once('./conexao_bd/conexao.php');
		
        $codigo = mysqli_real_escape_string($conexao, trim($_POST['codigo']));

		// criando a linha do  SELECT
        $sqlconsulta =  "select * from Lugar where codLocal = $codigo";
			
        $result = mysqli_query($conexao, $sqlconsulta);
        while($dado = $result->fetch_array()){  

	?>
<section class="container" style="top: 100%;">
        <body class="bg-dark">
						<div class="row">
							<div class="col p-1">
								<label><strong>Alterar Lugar</strong></label>
							</div>
						</div>
							<div class="row">
                            <form action="alterar.php" onchange="previewImagem()" method="post" enctype="multipart/form-data">
                                <div class="col-12 mb-3">
                                    <input name="codigo" type="text" value="<?php echo $dado['codLocal'];?>" readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="nome" type="text" value="<?php echo $dado['nomeLocal']; ?>">
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea name="hora" type="text" rows='6' cols='200' style="resize: none;" maxlength="200" ><?php echo $dado['horarioLocal']; ?></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="valor" type="text" id="valor" value="<?php echo $dado['precoLocal']; ?>" step="0.01" />
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="cep" type="text" id="cep" value="<?php echo $dado['cepLugar']; ?>" />
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="rua" type="text" value="<?php echo $dado['ruaLugar']; ?>" >
                                </div>
                                <div class="col-12 mb-3">    
                                    <input name="bairro" type="text" value="<?php echo $dado['bairroLugar']; ?>" >
                                </div>
                                <div class="col-12 mb-3">    
                                    <input name="cidade" type="text" value="<?php echo $dado['cidadeLugar']; ?>" >
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="numcasa" type="text" value="<?php echo $dado['numeroLugar']; ?>" placeholder="Número da casa" >
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea name="descricao" type="text" rows='10' cols='200' style="resize: none;" ><?php echo $dado['descLugar']; ?></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="lat" type="text" value = "<?php echo $dado['latLugar']; ?>" >
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="lng" type="text" value = "<?php echo $dado['lngLugar']; ?>" >
                                </div>
                            </div>    
						    <div class="row">
							<div class="col">
								<button type="submit" class="shadow">Alterar</button>
						    </div>
						    </form>
						    <div class="col">    
						        <button onclick="window.location='index_administrador.php';" value="Voltar">Voltar</button>  
						    </div>
                            </div>
        </section>
    <?php
        }
    ?>
</body>
</html>

