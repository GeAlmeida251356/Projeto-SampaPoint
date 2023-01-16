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
    <title>Incluir Lugar</title>

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


    </script>
</head>
<body>
    <div class="seta">
        <a href="index_administrador.php"><img src="../adm/Imagens/Imagens_index/seta_voltar.png"></a>
    </div>
<section class="container" style="top: 90%;">
        <body class="bg-dark">
						<div class="row">
							<div class="col p-1">
								<label><strong>Incluir Lugar</strong></label>
							</div>
						</div>
							<div class="row">
                                <form action="incluir.php" onchange="previewImagem()" method="post" enctype="multipart/form-data">
                                <div class="col-12 mb-3">
                                    <input name="nome" type="text" placeholder="Nome do Lugar" maxlength="50" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea name="hora" type="text" rows='6' cols='200' style="resize: none;" maxlength="200" placeholder="Horário"></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="valor" type="text" id="valor" placeholder="Valor" value="" maxlength="9" required/>
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
                                    <input name="numcasa" type="text" maxlength="11" placeholder="Número da casa">
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea name="descricao" type="text" rows='6' cols='200' style="resize: none;" maxlength="200" placeholder="Descrição"></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="lat" type="text" placeholder="Latitude" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <input name="lng" type="text" placeholder="Longitude" required>
                                </div>
                            </div>    
						    <div class="row">
							<div class="col">
								<button type="submit" class="shadow">Cadastrar</button>
						    </div>
						    </form>
						    <div class="col">    
						        <button onclick="window.location='index_administrador.php';" value="Voltar">Voltar</button>  
						    </div>
                            </div>
        </section>  
    </body>
</html>


