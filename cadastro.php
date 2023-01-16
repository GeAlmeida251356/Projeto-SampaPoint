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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style/cadastro.css">
    <title>Novo Usuario</title>

    <script type="text/javascript">
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };


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
						<div class="row">
							<div class="col p-1">
								<label><strong>Cadastro</strong></label>
							</div>
						</div>
							<div class="row">
                                <form action="cadastrar.php" onchange="previewImagem()" method="post" enctype="multipart/form-data">
                                <div class="col-12 mb-3">
                                    <input name="nome" type="text" placeholder="Nome Completo" maxlength="50" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="email" type="email" placeholder="Email" maxlength="50" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="cep" type="text" id="cep" placeholder="CEP" value="" maxlength="9" onblur="pesquisacep(this.value);" required/>
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="rua" type="text" id="rua" placeholder="Rua">
                                </div>
                                <div class="col-12 mb-3">    
                                    <input name="bairro" type="text" id="bairro" placeholder="Bairro">
                                </div>
                                <div class="col-12 mb-3">    
                                    <input name="cidade" type="text" id="cidade" placeholder="Cidade">
                                </div>
                                <div class="col-12 mb-3">
                                    <select id="uf" name="uf">
                                        <option value="">Estado</option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MS">MS</option>
                                        <option value="MT">MT</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="numcasa" type="text" maxlength="11" placeholder="Número da casa">
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="usuario" type="text" placeholder="Usúario" placeholder="Nome de usuário" maxlength="15" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="senha" type="password" placeholder="Senha" placeholder="Senha" maxlength="10" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea name="bio" type="text" rows='6' cols='200' style="resize: none;" maxlength="200" placeholder="Biografia"></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                <label for="arquivo" class="labelInput">Enviar foto de perfil:
                                    <input type="file" name="arquivo" id="arquivo" required><br><img src="./adm/Imagens/Imagens_index/selecionarimg.png" style="margin: 10px; width: 350px; height: 350px;">
                                </label>
                                </div>
                            </div>    
						    <div class="row">
							<div class="col">
								<button type="submit" class="shadow">Cadastrar</button>
						    </div>
						    </form>
						    <div class="col">    
						        <button onclick="window.location='login.php';" value="Voltar">Voltar</button>  
						    </div>
                            </div>
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