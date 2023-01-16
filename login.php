<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="imagex/png" href="./adm/Imagens/Imagens_index/logo.png">
    <link rel="stylesheet" type="text/css" href="style/login.css">
    <title>Login</title>
</head>
<body>
    <section class="container">
    	<?php
        	if(isset($_SESSION['nao_autenticado'])):
        ?>
        <div class="erro">
            <p>Usuário ou senha inválidos.</p>
        </div>
        <?php
            endif;
            unset($_SESSION['nao_autenticado']);
        ?>
        <body class="bg-dark">
			<div class="row">
				<div class="col p-1">
					<label><strong>Login</strong></label>
				</div>
			</div>
			<div class="row">
				<form action="logar.php" method="POST">
					<div class="col-12 mb-3">
						<input name="usuario" name="text" placeholder="Usuário">
					</div>
					<div class="col-12 mb-3">
						<input name="senha" type="password" placeholder="Senha">
					</div>
			</div>    
			<div class="row">
				<div class="col">
					<button type="submit" class="shadow">Entrar</button>
			</div>
			</form>
			<div class="col">    
				<button onclick="window.location='index.php';" value="Voltar">Voltar</button>  
			</div>
			<br>
		<div class="row">
			<div class="col">
				<p>Novo usuário?<a href="cadastro.php"> Cadastre-se aqui</a></p>
			</div>
		</div>
		</div>
    </section>
</body>
</html>