<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Denuncia</title>
	
  <link rel="icon" href="">
  <link rel="stylesheet"  href="css/bootstrap.min.css">
	<link rel="stylesheet"  href="css/nav.css">
  <link rel="stylesheet"  href="css/formularios.css">

<?php
if(!isset($_SESSION)){
      session_start();
      
      if(!isset($_SESSION["id"])){
        session_destroy();
        echo "<script>alert('Apenas usuarios logados podem realizar uma denuncia!');</script>";
        echo "<script>javascript:window.close();</script>";
      } else if($_SESSION["tipo"] == "adm"){
        echo "<script>window.location.replace('analiseDenuncia.php');</script>";
      }
}
?>

</head>

<body>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

  <script src="js/formularios.js"></script>
  <script src="js/select.js"></script>



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
      <a class="navbar-brand" href="index.php">PartYou</a>
    </div>

    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="cadastroDeEventos.php">Criar Evento</a></li>
        <li class="active"><a href="denuncia.php" target="_blank">Denunciar</a></li>
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
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["usuario"];?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="perfil.php?user=<?php echo $_SESSION["usuario"]; ?>">Perfil</a></li>
            <li><a href="logout.php">Sair</a></li>
          </ul>
        </li>
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->


</nav>
<!--Fim Nav-->

<!-- Início formulário-->

<div class="container">
    <div class="row">
        <h2>Denunciar</h2>
        <p class="lead">
            Você poderá denunciar eventos e usuário caso sinta-se atingido ou perceba que as regras de uso do site foram violadas.<br />
            
        </p>

        <div class="alert alert-warning">
            <h4>Regras:</h4>
            - Todas as denuncias realizadas são anonimas;<br>
            - As denuncias serão avalidas pelos administradores e serão tomadas as devidas providencias diante dos casos;<br>
        </div>
       
        <hr />

        <div class="row">
            <div class="col-sm-8">



                
                <form action="mysql/create/criar_denuncia.php" method="POST" role="form">

                  <h4 class="page-header">Tipo</h4>


                    <div class="radiozin">
                    
                        <input type="radio" name="tipo" value ="Evento" id="evento">
                        <label><h5>Evento</h5></label>
                        </div>

                    <div class="radiozin">
                        
                        <input type="radio" name="tipo" value="Usuario" id="usuario">
                        <label><h5>Usuário</h5></label>
                    </div>

                     <h4 class="page-header">Informações</h4>

                  <div class="comp form-group float-label-control">
                        <label for="">Nome</label>
                        <input name="nome" type="text" class="form-control" placeholder="Nome do usuário ou evento" required>
                    </div>
                    
                    
                     <div class="comp form-group float-label-control">
                        <label for="">Descrição</label>
                        <textarea name="descricao" class="comp form-control" placeholder="Descrição" rows="3" id="comp" required></textarea>
                    </div>

                 
                      <div class="row">
                   <div class="col-md-3">
                  <input type="submit" class="btn btn-default btn-lg btn-block btn-huge" value="Enviar"> 
                    </div>
                        </div>


               
        </div>
    </div>
</div>
</form>
<!-- Fim Formulário-->

</body>
</html>