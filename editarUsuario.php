<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PartYou</title>

    <link rel="icon" href="">
	<link rel="stylesheet"  href="css/bootstrap.min.css">
	<link rel="stylesheet"  href="css/nav.css">
 	<link rel="stylesheet"  href="css/formularios.css">

    <link rel="stylesheet"  href="css/editSenha.css">
    <link rel="stylesheet"  href="css/editSenha2.css">
    
  <?php 
    include("mysql/verifica_start_session.php");
    include("mysql/selectBD.php");
    $retorno = selectBD("telefone, nome, data_nascimento, email, descricao, logradouro, numero, complemento, bairro, cep","usuario inner join endereco","usuario.id", $_SESSION["id"]);
    $nascimento = explode("-", $retorno[0]["data_nascimento"]);
    $nascimento = $nascimento[2]."/".$nascimento[1]."/".$nascimento[0];
  ?>

 
</head>
<body>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/formularios.js"></script>
	<script src="js/select.js"></script>
  <script src="js/senha.js"></script>
  <script src="js/mascaraDeData.js"></script>
  <script src="js/nomeUsuario.js"></script>
  <script src="js/mascTelefone.js"></script>
   

    
<!-- Nav -->

<nav class="navbar navbar-default navbar-inverse" role="navigation">
  <div class="container-fluid">
  
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php">PartYou</a>
    </div>


    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="cadastroDeEventos.php">Criar Evento</a></li>
        <li><a href="denuncia.php" target="_blank">Denunciar</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorias <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="search.php?categorias=balada">Balada</a></li>
            <li><a href="search.php?categorias=free">Free</a></li>
            <li><a href="search.php?categorias=cultura">Cultural</a></li>
            <li><a href="search.php?categorias=tematica">Temática</a></li>
            <li><a href="search.php?categorias=infantil">Infantil</a></li>
            <li><a href="search.php?categorias=18">+18</a></li>
             <li><a href="search.php?categorias=religioso">Religioso</a></li>
            <li><a href="search.php?categorias=lgbt">LGBT</a></li>
            <li><a href="search.php?categorias=lual">Lual</a></li>
             <li><a href="search.php?categorias=show">Show</a></li>
            <li><a href="search.php?categorias=bar">Bar</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search" method="GET" action="search.php">
       <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" class="  search-query form-control" name="search" placeholder="Buscar..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="submit">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
      </form>
      

       <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["usuario"]; ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="perfil.php?user=<?php echo $_SESSION["usuario"];?>">Perfil</a></li>
            <li><a href="logout.php">Sair</a></li>
          </ul>
        </li>
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->


</nav>
<!--Fim Nav-->

<!-- Formulário -->

<div class="container">
    <div class="row">
        <h2>Editar</h2>
        <p class="lead">
            Editar informações de usuário.
            <br />
            
        </p>

       
        <hr />

        <div class="row">
            <div class="col-sm-8">

                <h4 class="page-header">Pessoal</h4>
                <form id="form" role="form" method="POST" action="mysql/update/alterar_usuario_endereco.php">
                	 <div class="form-group float-label-control">
                        <label for="">Nome</label>
                        <input name="nome" type="text" class="form-control" value="<?php echo $retorno[0]['nome']?>" placeholder="Nome" maxlength="45" required>
                    </div>

                   <div class="form-group float-label-control">
                    <a href="#trocarsenha">Clique aqui para trocar a senha</a>
                   </div>

                     <div class="form-group float-label-control">
                        <label for="">dd/mm/aaaa</label>
                        <input name="dataNasc" id="dataNasc" value= "<?php echo $nascimento?>" type="text" class="form-control" placeholder="Data de nascimento" onkeyup="masc(this.id);" maxlength="10">
                    </div>

                    <div class="form-group float-label-control">
                        <label for="">(xx) xxxxx-xxxx</label>
                        <input name="telefone" id="telefone01" type="text" value ="<?php echo $retorno[0]['telefone']?>" class="form-control" placeholder="Telefone" onkeyup="mascTelefone(this.id);" maxlength="17">
                    </div>
                    <div class="comp form-group float-label-control">
                        <label for="">Email</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $retorno[0]['email']?>" required>
                    </div>

                     <div class="comp form-group float-label-control">
                        <label for="">Descrição</label>
                        <textarea name="descricao" value ="<?php echo $retorno[0]['descricao']?>" class="form-control" id="descricao" placeholder="Descrição" rows="3" maxlength="500"><?php echo$retorno[0]["descricao"] ?></textarea>
                    </div>

                    



                <h4 class="page-header">Endereço</h4>
           

                	<div class="form-group float-label-control" id="comp">
                        <label for="">Logradouro</label>
                        <input name="logradouro" type="text" value ="<?php echo $retorno[0]['logradouro']?>" class="form-control" placeholder="Logradouro">
                    </div>
                    <div class="form-group float-label-control">
                        <label for="">Número</label>
                        <input name="numero" type="text" value ="<?php echo $retorno[0]['numero']?>" class="form-control" placeholder="Número" maxlength="5">
                    </div>
                    <div class="form-group float-label-control">
                        <label for="">Complemento</label>
                        <input name="complemento" type="text" value="<?php echo $retorno[0]['complemento']?>" class="form-control" placeholder="Complemento">
                    </div>
                    <div class="form-group float-label-control">
                        <label for="">Bairro</label>
                        <input name="bairro" type="text" value="<?php echo $retorno[0]['bairro']?>" class="form-control" placeholder="Bairro">
                    </div>

                     <div class="form-group float-label-control">
                        <label for="">CEP</label>
                        <input name="cep" type="text" value="<?php echo $retorno[0]['cep']?>" class="form-control" placeholder="CEP">
                    </div>
                    

                     <div id="sel-1" class="float-label-control label-bottom">
                    	 <div class=" col-md-6 mb-3">
  				
    			<select class="form-control form-control-lg" name="estado" id="validationCustom03" onchange="cidad(this.id);" required>
      				<option value="">UF</option>
      				<option value="PE">Pernambuco</option>
        			<option value="BA">Bahia</option>
        			<option value="PB">Paraíba</option>
        			
      			</select>
						</div>


			  	<div class=" col-md-6 mb-3">
     			<select class="form-control form-control-lg" id="cidade" name="cidade" required></select>
     		</div>
    				

  				</div>
     <hr />


                    <div class="row">
        <div class="col-md-3">
            <input type="submit" class="btn btn-default btn-lg btn-block btn-huge" value="Pronto"> 
        </div>
            </div>
           
        </div>
    </div>
</div>
</form>
<!-- Fim Formulário-->


<div id="trocarsenha" class="modalDialog">
<div class="div-popup">
<a href="#fechar" title="Fechar" class="fechar">X</a>
<h2>Senha</h2>
<form action="mysql/update/alterar_senha.php" method="POST">
<div class="form-entra form-groupo" id="espaco-baixo">
<label for="senhaAtual">Senha atual</label>
<input name="senhaAtual" id="senhaAtual" type="password" class="form-control" maxlength="16" minlength="8" required>
<br>

<label class="senhaNova">Nova senha </label>
<input name="senha" id="senhaNova" type="password" class="form-control conf-passwd" maxlength="16" minlength="8" required>
<br>

<label class="senhaConfirmacao">Confirmar senha </label>
<input name="confirmSenha" id="confirmacaoDeSenha" type="password" class="form-control conf-passwd" maxlength="16" minlength="8" onblur="sConfirm();" required>
<br>


<hr/>
 
            <button type="submit" class="btn btn-default   btn-lg">Enviar</button>
</div>

</div>


        
</form>
</div>
<!-- fim telinha de login-->



</body>
</html>