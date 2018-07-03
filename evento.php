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
    <link rel="stylesheet"  href="css/login.css">
    <link rel="stylesheet"  href="css/form-popup.css">
    <link rel="stylesheet"  href="css/evento.css">
    <link rel="stylesheet"  href="css/comentario.css">
    <style>
        
.margem{
    margin-bottom: 0px;
}

    </style>
    
    <?php
      if(!isset($_SESSION)){
        session_start();
        
        if(!isset($_SESSION["id"])){
          $_SESSION["id"] = "";
          $_SESSION["tipo"] = "";
          session_destroy();
        }
      }

      if(!isset($_GET["evento"])){
        echo "<script>window.location.replace('home.php');</script>";
      }

      $evento = $_GET["evento"];
      
      include("mysql/dinamic_event.php");

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
      <?php 
     if(isset($_SESSION["usuario"])){ ?>

    <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["usuario"] ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="perfil.php?user=<?php echo $_SESSION['usuario']; ?>">Perfil</a></li>
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

    <?php } ?>
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->

      <!-- Colocar a estrutura de  perfil-->

</nav>
<!--Fim Nav-->

<!--Perfil-->

<div class="container">


<div class="col-lg-6 col-sm-6" id="profile-150">
    <div class="card hovercard">
        <div class="card-background">
            <img class="card-bkimg" alt="" src=<?php echo $fotoevento; ?>>
                    </div>

         <div class="data-inicio card-info"> 
          <div class="dia cartao-data"><?php echo diaEvento($dataInicio); ?></div>
       
          <div class="mes cartao-data"><?php echo mesEvento($dataInicio); ?></div>

          </div>


        <div class="card-info"> 
          <span class="card-title"><?php echo $linha['nome']?></span>
        </div>

<!--Botões do perfil-->
<?php
if(isset($_SESSION)){
  $evento = separarNomeEvento($_GET["evento"]);
  $id = pegarIdPorNome("id_usuario", "evento", $evento);
  if($id == $_SESSION["id"]){
?>
     <div class="botoes-perfil">
      

        
        <nav class=" navbar navbar-nav" >
          
           <a href="editarEvento.php?idEvento=<?php echo $evento; ?>" target="_blank"><button type="button" class="btn btn-default btn-round-md btn-md"><i class="glyphicon glyphicon-edit" title="Editar"></i></button></a>

               <a href="#abirEdicao"><button type="button" class=" btn btn-default btn-round-md btn-md" title="Aparência"><i class="glyphicon glyphicon-picture"></i></button></a>

               <a href="#delete-perfil"><button type="button" class=" btn btn-default btn-round-md btn-md" title="Deletar"><i class="
glyphicon glyphicon-trash"></i></button></a>
                 </nav>
                </div>
<?php
  }else if ($_SESSION["tipo"] == "adm") {
  ?>
    <div class="botoes-perfil">
      

        
        <nav class=" navbar navbar-nav" >
               <a href="#delete-perfil"><button type="button" class=" btn btn-default btn-round-md btn-md" title="Deletar"><i class="
glyphicon glyphicon-trash"></i></button></a>
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
}
?>
  <!--Fim dos botões do perfil-->

<!--Popup de aparencia-->
                <div id="abirEdicao" class="modalDialog">
              <div class="div-popup">
                    <a href="#fechar" title="Fechar" class="fechar">X</a>
                  <h2>Aparência</h2>
                <form method="POST" action="mysql/update/alterar_evento_aparencia.php" enctype="multipart/form-data">
                  <div class="form-group">
                          <label for="">Foto de Evento</label>
                          <input name="fotoEvento" type="file" class="form-control" >
                      </div>
              <hr/>
                      <button type="submit" name="nome" value="<?php echo $evento; ?>" class="btn btn-default  btn-lg">Enviar</button>

                  </form>
              </div>     
              </div>

<!--Fim de popup de aparencia-->

<!--Popup de deletar-->

            
            <div id="delete-perfil" class="modalDialog">
              <div class="div-popup">
                    <a href="#fechar" title="Fechar" class="fechar">X</a>
                  <h2>Deletar Evento</h2>
                  <h4>Deseja deletar o evento?</h4>
                <form action="mysql/delete/deletar_evento_localizacao.php?evento=">
                 
<hr/>
                      <button type="submit" name="evento" value="<?php echo $evento;?>" class="btn btn-default  btn-lg">Sim</button>

                </form>
                 </div> 
              </div>

<!--Fim deletar perfil-->               
      </div>

        </div>
  

    <div class="btn-pref btn-group btn-group-justified btn-group-lg" id="abas" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="botao-cor btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-glass" aria-hidden="true"></span>
                <div class="hidden-xs">Sobre o Evento</div>
            </button>
        </div>
      
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="
glyphicon glyphicon-comment" aria-hidden="true"></span>
                <div class="hidden-xs">Descobrir</div>
            </button>
        </div>
    </div>

        <div class="well">
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab1">
          <h3>Sobre</h3>

          
            <div>
            <blockquote>
              <p><?php echo $linha["nome"]?></p>
              <p><?php echo $linha["nome_usuario"]?></p>

                 <small><cite title="Source Title"><?php echo $endereco?>  
                  <i class="glyphicon glyphicon-map-marker"></i></cite></small>
            </blockquote>
            <p> 

              <div class="sobre-atributos">
                <i class="glyphicon glyphicon-tags"></i> <?php echo $categorias; ?>;
                <br/> 
              </div>


             
            <div class="sobre-atributos">
                <i class="glyphicon glyphicon-ok"></i><?php echo horarioEvento($linha["hora_inicio_evento"])." - ".$dataInicio; ?>
                <br/> 
              </div>
              <div class="sobre-atributos">
                <i class="glyphicon glyphicon-remove"></i><?php echo horarioEvento($linha["hora_final_evento"])." - ".$dataFim; ?>
                <br/>
                <br/>
             </div>   
              <div class="descricao-usuario sobre-atributos">
              <p><i class="glyphicon glyphicon-pencil"></i><?php echo $linha['descricao'];?>
               </p>
               <div class="sobre-atributos">
                <p><i class="glyphicon glyphicon-info-sign"></i>
                  <?php echo $linha["informacao"];?></p>

                </p>
             </div>  
            </div>

            </p>
        </div>
        </div> 

        <!--Fim de carrossel lista-->
        
        <div class="tab-pane fade in" id="tab3">
          <h3>Colaborações</h3>

<?php if(!isset($_SESSION["usuario"])){
    echo "É preciso estar logado para comentar";
}else{ ?>
  <form action="mysql/create/criar_comentario.php?evento=<?php echo $evento; ?>&user=<?php echo $_SESSION['usuario']; ?>" method="POST">
       <div class="col-md-6">
                <div class="form-group">
                          <label for="">Comentar</label>
                          <textarea name="comentario" class="form-control" placeholder="Colaborar..." rows="3" ></textarea>

                           <div class="row">
                    <input type="submit" class="btn-huge btn btn-danger btn-lg btn-block" id="tam-botao" value="Pronto"> 
                          </div>

                      </div>

                        
            </div>
      </form>
<?php }?>

<div class="container-fluid" style="padding-top:30px">
  <div class="row">
    <div class="bla col-sm-6" >

      <!--inicio visual dos comentarios-->
            <?php foreach ($comentarios as $valor) {
            $fotocoment = "imagens/perfil/".$valor["foto"]; ?>

            <div id="tb-testimonial" class="testimonial testimonial-default">
                <div class="testimonial-section">
                  <?php echo $valor["conteudo"] ?>
              </div>
                <div class="testimonial-desc">
              <img src="<?php echo $fotocoment; ?>" alt="" width=100px height=100px> 
                    <div class="testimonial-writer">
                      <div class="testimonial-writer-name"><a href="perfil.php?user=<?php echo $valor["nome_usuario"]; ?>"><?php echo $valor["nome"]; ?></a></div>
                      <div class="testimonial-writer-designation"><?php echo $valor["nome_usuario"]; ?></div>
                    </div>
                </div>
            </div>   
          <?php }?>
        
      <!--fim visual dos comentários-->

    </div>
  </div>  
        </div>


  </div>    

    
   

      
    
<!--Fim perfil-->

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