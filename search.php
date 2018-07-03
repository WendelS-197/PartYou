<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PartYou</title>

    <link rel="icon" href="">
  <link rel="stylesheet"  href="css/bootstrap.min.css">
    <link rel="stylesheet"  href="css/home.css">
    <link rel="stylesheet" 	href="css/login.css">
    <link rel="stylesheet" 	href="css/form-popup.css">

    <style>
        
    .margem{
        margin-bottom: 0px;
    }

    </style>

  <?php
    include("mysql/conexao.php");
    include("mysql/CN.php");
    
    if (isset($_GET["search"])) {
      $query = "select id, nome, descricao, fotoevento, data_inicio_evento, hora_inicio_evento from evento where nome like '%".$_GET["search"]."%';";
      $stmt = $conexao->prepare($query);
      $stmt->execute();

    }else if (isset($_GET["categorias"])) {
      $query = "select id, nome, descricao, fotoevento, data_inicio_evento, hora_inicio_evento from evento where categoria1 = '".$_GET["categorias"]."' or categoria2 = '".$_GET["categorias"]."' or categoria3 = '".$_GET["categorias"]."';";
      $stmt = $conexao->prepare($query);
      $stmt->execute();
    }



    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

  ?>

</head>
<body>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/carrossel1.js"></script>
  <script src="js/select.js"></script>
    <script src="js/checkbox.js"></script>
    <script src="js/mascaraDeData.js"></script>
    <script src="js/nomeUsuario.js"></script>
    <script src="js/mascTelefone.js"></script>
    <script src="js/mascHora.js"></script>
    <script src="js/perfil.js"></script>
    <script src="js/home.js"></script>

<!-- Nav -->

<nav class="navbar navbar-default navbar-inverse margem" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php">PartYou</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="cadastroDeEventos.php">Criar Evento</a></li>
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
     
     <?php
     if(!isset($_SESSION)){
        session_start();   
      }
     if(isset($_SESSION["usuario"])){ ?>

 		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["usuario"]; ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="perfil.php?user=<?php echo $_SESSION["usuario"]; ?>">Perfil</a></li>
            <li><a href="logout.php">Sair</a></li>
          </ul>
        </li> <?php
     } else{ ?>
     		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Entrar<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#abrirmodal">Entrar</a></li>
            <li><a href="cadastroDeUsuario.html">Inscrever</a></li>
          </ul>
        </li>

    <?php 
      session_destroy();
      } ?>





      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->


</nav>
<!--Fim Nav-->


<div class="index-content">
   <?php 
    $count = 0;
    for($i = 0; $i <= sizeof($resultado)/3; $i++) { ?> 
        <div class="container"> <?php 
        for($j = $count; $j < $count+3; $j++){
          if($j == sizeof($resultado)){
            break;
          } ?>
          <a href=<?php echo "evento.php?evento=".juntarNomeEvento($resultado[$j]["nome"]); ?>>
                <div class="col-lg-4">
                    <div class="card">
            <?php  echo "<img src='imagens/eventos/".$resultado[$j]["fotoevento"]."' width='300px' height='200px' >"; ?>
                        <h4><?php echo $resultado[$j]["nome"] ?></h4>
                        <p><?php echo $resultado[$j]["descricao"] ?> </p>
                       <p class="card-text camp-time"><small><em><?php echo $resultado[$j]["data_inicio_evento"]." - ".$resultado[$j]["hora_inicio_evento"] ?></em></small></p>
                        <a href="#" class="blue-button">Visualizar</a>
                    </div>
                </div>
            </a>
  <?php } ?>
    </div> <?php
    $count += 3;
  } ?>

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



</body>
</html>


