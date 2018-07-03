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
  <link rel="stylesheet"  href="css/login.css">

  <link rel="stylesheet"  href="css/form-popup.css">

<?php

  include("mysql/conexao.php");

  if(!isset($_SESSION)){
    session_start();
    if (!isset($_SESSION["id"])) {
      echo "<script>alert('Apenas administradores podem analisar uma denuncia!');</script>";
      echo "<script>window.location.replace('home.php');</script>";

    }else if($_SESSION["tipo"] == "comum"){
      echo "<script>alert('Apenas administradores podem analisar uma denuncia!');</script>";
      echo "<script>window.location.replace('home.php');</script>";
    }
  }

  $stmt = $conexao->prepare("select id, tipo, nome, descricao from denuncia");

  $stmt->execute();

  $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); 

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
      <a class="navbar-brand" href="home.php">PartYou</a>
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


<div class="container">
	<div class="row">
		<h2>Denuncias não analisadas</h2>
	</div>
    <div class="row">
        <div class="table-responsive">
  <table class="table table-bordered">
  <thead>
     <tr class="active">
         <th>Código</th>
         <th>Tipo</th>
         <th>Nome</th>
         <th>Descrição</th>
         <th>Excluir</th>
     </tr> 
  </thead>
  <tbody>
    <?php foreach ($resultado as $valor) { ?>
      <tr>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <td class="editable"><?php echo $valor["id"]; ?></td>
          </div>
          
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <td class="editable"><?php echo $valor["tipo"]; ?></td>
          </div>
          
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <td class="editable"><?php echo $valor["nome"] ?></td>
          </div>
          
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <td class="editable"><?php echo $valor["descricao"] ?></td>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <td class="editable"> <a href="#delete-perfil-<?php echo $valor['id']; ?>"><button type="button" class=" btn btn-default btn-round-md btn-md" title="Deletar"><i class="
glyphicon glyphicon-trash"></i></button></a> </td>
          </div>
      </tr>
   <?php } ?>
      
  </tbody>
</table>
</div>
    </div>
</div>
<?php foreach ($resultado as $valor) { ?>
 <div id="delete-perfil-<?php echo $valor['id']; ?>" class="modalDialog">
              <div class="div-popup">
                    <a href="#fechar" title="Fechar" class="fechar">X</a>
                  <h2>Deletar Denuncia</h2>
                  <h4>Deseja deletar a denuncia?</h4>
                <form action="mysql/delete/delete_denuncia.php" method="POST">
                 
<hr/>
                      <button type="submit" name="deletar" value=<?php echo $valor["id"]; ?>  class="btn btn-default  btn-lg">Sim</button>

                </form>
                 </div> 
              </div>
<?php } ?>

</body>
</html>