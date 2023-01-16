<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SampaPoint</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="imagex/png" href="./adm/Imagens/Imagens_index/logo.png">
</head>
<style>
	body{
	margin: 0;
	padding: 0;
	font-family: Arial, Helvetica, sans-serif;
}
.banner{
	width: 100%;
	height: 100vh;
	background-image: url(./adm/Imagens/Imagens_index/fundo4.jpg);
	background-size: cover;
	background-position: center;
	position: fixed;
}
.botão{
	width: 100%;
	position: absolute;
	top: 50%;
	transform: translateY(180%);
	text-align: center;
}

button{
	width: 200px;
	padding: 15px 0;
	text-align: center;
	margin: 20px 10px;
	border-radius: 20px;
	border: 2px solid white;
	background: transparent;
	color: whitesmoke;
	font-size: large;
	cursor: pointer;
	position: relative;
	overflow: hidden;
}
span{
	background: #111111;
	height: 100%;
	width: 0;
	border-radius: 20px;
	position: absolute;
	left: 0;
	bottom: 0;
	z-index: -1;
	transition: 0.8s;
}
button:hover span{
	width: 100%;
}
button:hover {
	border: 2px solid white;
}

.socials{
	height: 50px;
	list-style: none;
	display: flex;
	align-items: center;
	justify-content: center;
	margin: auto;
}
.socials li{
	margin: 0 10px;
}
.socials a{
	text-decoration: none;
	color: #fff;
}
.socials a i{
	font-size: 1.1rem;
	transition: color .4s ease;
}
.socials a:hover i{
	color: #333333;
}
</style>
<body>
	<div class="banner">
			<div class="botão">
				<a href="./login.php"><button type="button"><span></span>Login</button></a>
			</div>		
		<ul class="socials">
			<li><a href="https://www.instagram.com/sampapoint262/" target="_blank"><i class="fa fa-instagram"></i></a></li>
			<li><a href="https://www.youtube.com/channel/UCYfI1mO3LFTu30JInTLnxEg" target="_blank"><i class="fa fa-youtube"></i></a></li>
			<li><a href="mailto:sppoint262@gmail.com?subject=SampaPoint" target="_blank"><i class="fa fa-google"></i></a></li>		
		</ul>
	</div>
</body>
</html>

