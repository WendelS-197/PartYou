<!DOCTYPE html>
<html lang="pt-br">
<head>

  <?php
      if(!isset($_SESSION)){
        session_start();
        if(isset($_SESSION["id"])){
          echo "<script>window.location.replace('perfil.php?user=".$_SESSION["usuario"]."');</script>";
        }
      }
  ?>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>PartYou</title>
	<link rel="stylesheet"  href="css/bootstrap.min.css">
	<link rel="stylesheet"  href="css/index.css">
  <link rel="stylesheet"  href="css/login.css">
  <link rel="stylesheet"  href="css/form-popup.css">
  


</head>

<body>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script src="js/nomeUsuario.js"></script>

	<!--Início de tela inicial-->


<div class="site-wrapper">
  <div class="site-wrapper-inner">
    <div class="cover-container">
      <div class="masthead clearfix">
        <div class="inner">
          <h3 class="masthead-brand">PartYou</h3>

          <ul class="nav masthead-nav">
            <li class="active">
              <a href="home.php" target=
              "_blank">Descobrir</a>
            </li>


            
          </ul>
        </div>
      </div>

      <div class="inner cover">
        <h1 class="cover-heading">É evento que você quer @?</h1>

        <p class="lead">Apenas aqui você encontra e cria os seus eventos de forma totalmente gratuita! Nós do PartYou, acreditamos que momentos compartilhados se tornam memórias e histórias incríveis.
            
        <small>    <br> Você merece isso!</small>
            
        </p>

        <p class="lead"><a class="botaozin btn btn-lg btn-info" id="botao" href="cadastroDeUsuario.html">Inscreva-se</a></p>
        <a href="#abrirmodal">Entrar</a>
      </div>

<!-- Telinha de login -->
      <div id="abrirmodal" class="modalDialog">
<div class="div-popup">
<a href="#fechar" title="Fechar" class="fechar">X</a>
<h2>Entrar</h2>
<form action="login.php" method="POST">
<div class="form-entra form-group" id="espaco-baixo">
<label for="usuario">Usuário </label>
<input type="text" class="form-control" name="usuario" id="usuariLogin" onkeydown="mascUsuario(this.id);" onkeyup="sEspaco(this.id)">

<label class="senha">Senha </label>
<input type="password" class="form-control" name="senha">
<br>
</div>

<a href="cadastroDeUsuario.html" class="form-entra">Inscreva-se</a>
<br>
<hr/>
 
            <button type="submit" class="btn btn-default   btn-lg">Enviar</button>
        
</form>
</div>
</div>
<!-- fim telinha de login-->


      <div class="mastfoot">
        <div class="inner">
          <!-- Validation -->

          

          <p>© 2018 PartYou</p>
        </div>
      </div>
    </div>
</div>
</div>
	<!--Fim de tela inicial-->
</body>