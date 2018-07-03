<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PartYou</title>

    <link rel="icon" href="">
	<link rel="stylesheet"  href="css/bootstrap.min.css">
    <link rel="stylesheet"  href="css/carrossel1.css">
    <link rel="stylesheet"  href="css/form-popup.css">
    <link rel="stylesheet"  href="css/perfil.css">

    <style>
        
    .margem{
        margin-bottom: 0px;
    }

    </style>

  <?php
  if(!isset($_SESSION)){
      session_start();
      
      if(!isset($_SESSION["id"])){
        session_destroy();
        echo "<script>window.location.replace('home.php');</script>";
      }else{
        if(!isset($_GET["user"])){
          echo "<script>window.location.replace('perfil.php?user=".$_SESSION["usuario"]."');</script>";
        }
      }
}
  
    include("mysql/verifica_start_session.php");
    include("mysql/dinamic_perfil.php");
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
    <script src="js/formularios.js"></script>

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
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["usuario"] ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="perfil.php?user=<?php echo $_SESSION['usuario'];?>">Perfil</a></li>
            <li><a href="logout.php">Sair</a></li>
          </ul>
        </li>
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->


</nav>
<!--Fim Nav-->

<!--Perfil-->

<div class="container">
  <div class="row">

<div class="col-lg-6 col-sm-6" id="profile-150">
    <div class="card hovercard">
        <div class="card-background">
              <img class="card-bkimg" alt="" src=<?php echo $capa; ?>>
        </div>
        <div class="flutua useravatar">
              <img alt="" src=<?php echo $foto; ?>>
        </div>

        <div class="card-info"> 
          <span class="card-title"><?php echo $nome; ?></span>
        </div>


<!--Botões do perfil-->
<?php if($_GET['user'] == $_SESSION["usuario"]){?>
     <div class="botoes-perfil">
      

        
        <nav class=" navbar navbar-nav" >
          
           <a href="editarUsuario.php" target="_blank"><button type="button" class="btn btn-default btn-round-md btn-md" title="Editar"><i class="glyphicon glyphicon-edit"></i></button></a>

               <a href="#abirEdicao"><button type="button" class=" btn btn-default btn-round-md btn-md" title="Aparência"><i class="glyphicon glyphicon-picture"></i></button></a>

               <a href="#delete-perfil"><button type="button" class=" btn btn-default btn-round-md btn-md" title="Deletar"><i class="
glyphicon glyphicon-trash"></i></button></a>
                 </nav>
                </div>
 <?php
    }else if($_SESSION["tipo"] == "adm"){ ?>

       <div class="botoes-perfil">
        <nav class=" navbar navbar-nav" >
           <a href="#delete-perfil"><button type="button" class=" btn btn-default btn-round-md btn-md" title="Deletar"><i class="glyphicon glyphicon-trash"></i></button></a>
        </nav>
        </div>
   <?php
    }else{
  ?>
  <div class="botoes-perfil">
        <nav class=" navbar navbar-nav" >
        </nav>
        </div>
  <?php
   }
  ?>
  <!--Fim dos botões do perfil-->

<!--Popup de aparencia-->
                <div id="abirEdicao" class="modalDialog">
              <div class="div-popup">
                    <a href="#fechar" title="Fechar" class="fechar">X</a>
                  <h2>Aparência</h2>
                <form action="mysql/update/alterar_usuario_aparencia.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                          <label for="">Foto de Perfil</label>
                          <input name="fotoPerfil" type="file" value="bixa.png" class="form-control" >
                  </div>

                  <div class="form-group">
                          <label for="">Foto de Capa</label>
                          <input name="fotoCapa" type="file" class="form-control">
                      </div>
              <hr/>
                      <button type="submit" class="btn btn-default  btn-lg">Enviar</button>

                  </form>
              </div>     
              </div>

<!--Fim de popup de aparencia-->

<!--Popup de deletar-->

            
           <div id="delete-perfil" class="modalDialog">
              <div class="div-popup">
                    <a href="#fechar" title="Fechar" class="fechar">X</a>
                  <h2>Deletar Perfil</h2>
                  <h4>Deseja deletar o perfil?</h4>
                <form action="mysql/delete/delete_usuario_endereco.php" method="POST">
                 
<hr/>
                      <button type="submit" name="user" value = "<?php echo $_GET['user']?>" class="btn btn-default  btn-lg">Sim</button>

                </form>
                 </div> 
              </div>

<!--Fim deletar perfil-->               
      </div>

        </div>

    <div class="btn-pref btn-group btn-group-justified btn-group-lg" id="abas" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="botao-cor btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span>
                <div class="hidden-xs">Sobre o Usuário</div>
            </button>
        </div>
      
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                <div class="hidden-xs">Eventos Criados</div>
            </button>
        </div>
    </div>

        <div class="well">
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab1">
          <h3>Sobre</h3>

          
            <div>
            <blockquote>
              <p><?php echo $nome; ?></p>

                 <small><cite title="Source Title"> <?php echo $endereco; ?><i class="glyphicon glyphicon-map-marker"></i></cite></small>
            </blockquote>
            <p> 
             
            <div class="sobre-atributos">
                <i class="glyphicon glyphicon-user"></i><?php echo $_GET["user"]; ?>
                <br/> 
              </div>
              <div class="sobre-atributos">
                <i class="glyphicon glyphicon-gift"></i> <?php echo $nascimento;?>
                <br/>
             </div>   
              <div class="descricao-usuario sobre-atributos">
              <p><i class="glyphicon glyphicon-pencil"></i><?php echo $descricao?></p>
            </div>

            </p>
        </div>
        </div> 

        <!--Fim de carrossel lista-->
        
        <div class="tab-pane fade in" id="tab3">
          <h3>Eventos Criados Por Uste Usuário</h3>


           <!-- carrossel lista 1-->
<?php if(sizeof($retorno) != 0){ ?>

<div  class="cont-carrossel">
  <div class='row'>
    <div class='col-md-8'>
      <div class="carousel slide media-carousel" id="media">
        <div class="carousel-inner">
         
          <?php 
          $count = 0;
          for($i = 0; $i <= sizeof($retorno)/3; $i++) {
            if($i == 0){
              echo "<div class='item  active'>";
            }else{
              echo "<div class='item'>";
            }
            ?>
            
            <div class="row">
          <?php for($j = $count; $j < $count+3; $j++){
                  if($j == sizeof($retorno)){
                    break;
                  } ?>
              <div class="col-md-4">
                <a class="thumbnail" href="evento.php?evento=<?php echo juntarNomeEvento($retorno[$j]['nome']); ?>"><img title="<?php echo $retorno[$j]['nome']; ?>" src="imagens/eventos/<?php echo $retorno[$j]['fotoevento']; ?>" width=150px height=100px></a>
              </div>          
          <?php } ?>

            </div>
          </div>
        <?php 
        $count+=3;
      } ?>

        </div>
        <a data-slide="prev" href="#media" class="left carousel-control">‹</a>
        <a data-slide="next" href="#media" class="right carousel-control">›</a>
      </div>                          
    </div>
  </div>

<?php }else{
  echo "Não há eventos criados pelo usuário.";
} ?>

</div> 




      
         
        </div>
      </div>
    </div>
    </div>
    </div>
            
    
<!--Fim perfil-->

</body>
</html>