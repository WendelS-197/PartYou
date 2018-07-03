<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cadastro De Evento</title>

    <link rel="icon" href="imagens/favicon.ico">
	<link rel="stylesheet"  href="css/bootstrap.min.css">
	<link rel="stylesheet"  href="css/nav.css">
    <link rel="stylesheet"  href="css/carrossel.css">
 	<link rel="stylesheet"  href="css/formularios.css">
    <?php
		if(!isset($_SESSION)){
      		session_start();
      
      		if(!isset($_SESSION["id"])){
        		session_destroy();
        		echo "<script>alert('Apenas usuarios logados podem criar eventos!');</script>";
        		echo "<script>window.location.replace('home.php');</script>";
      		}
		}
	?>
</head>
<body>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/formularios.js"></script>
	<script src="js/select.js"></script>
    <script src="js/checkbox.js"></script>
    <script src="js/mascaraDeData.js"></script>
    <script src="js/nomeUsuario.js"></script>
    <script src="js/mascTelefone.js"></script>
    <script src="js/mascHora.js"></script>

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
        <li class="active"><a href="#">Criar Evento</a></li>
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
            <li><a href="perfil.php?user=<?php echo $_SESSION["usuario"]; ?>">Perfil</a></li>
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
        <h2>Cadastro de Evento</h2>
        <p class="lead">
            Sua festa é a nossa. cadastre seu evento e convide pessoas. Vamos lá, vai ser legal!!<br />
            
        </p>

      
        <div class="alert alert-warning">
            <h4>O Usuário deve está ciente de que:</h4>
           - Todo evento criado será avaliado, caso seja necessário.<br>
           - Deve ser reportado aos desenvolvedores quaisquer erros.<br>
           - Deve-se estar ciente dos termos de uso e política de privacidade do sistema.
        </div>
				
        <hr />

        <div class="row">
            <div class="col-sm-8">

                <h4 class="page-header">Informações básicas</h4>
                <form role="form" method="POST" action="mysql/create/criar_evento_locale.php">
                	<div class="comp form-group float-label-control">
                        <label for="">Nome</label>
                        <input name = "nome" type="text" class="form-control" placeholder="Nome" required>
                    </div>
                    
                     <div class="form-group float-label-control">
                        <label for="">dd/mm/aaaa</label>
                        <input name="dataInicio" id="dataInicio" type="text" class="form-control" placeholder="Data de início" onkeyup="masc(this.id);" maxlength="10" required>
                    </div>

                    <div class="form-group float-label-control" name="senha-conf">
                        <label for="">hh:mm</label>
                        <input name="horaInicio" id="horaInicio" type="text" class="form-control" placeholder="Hora de Início" maxlength="5" onkeyup="horas(this.id);" required>
                    </div>

                     <div class="form-group float-label-control">
                        <label for="">dd/mm/aaaa</label>
                        <input name="dataFim" id="dataFim" type="text" class="form-control" placeholder="Data de término" onkeyup="masc(this.id);" maxlength="10" required>
                    </div>
                    <div class="form-group float-label-control" name="senha-conf">
                        <label for="">hh:mm</label>
                        <input name="horaFim" id="horaFim" type="text" class="form-control" placeholder="Hora de término" maxlength="5" onkeyup="horas(this.id);" required>
                    </div>
                    
                   

                    <div class="comp form-group float-label-control">
                        <label for="">Descrição</label>
                        <textarea name="descricao" class="form-control" placeholder="Descrição" rows="3" maxlength="500"></textarea>
                    </div>
              
                     <div class="comp form-group float-label-control">
                        <label for="">Informações Adicionais</label>
                        <textarea name="informacao" class="comp form-control" placeholder="Informações Adicionais" rows="3" maxlength="500"></textarea>
                    </div>

                     <h4 class="page-header" >Categorias</h4>
               
                     <i class="arrumando">Escolha apenas 3 categorias:</i>

               <div class="form-group float-label-control " id="comp">
                     
                       <span class="button-checkbox">
                     <button type="button" class="btn btn-checkbox" data-color="default" name="balada-btn">Balada</button>
                     <input type="checkbox" name="1" value="balada" class="hidden form-control"/>
                        </span>

                         <span class="button-checkbox">
                     <button type="button" class="btn btn-checkbox" data-color="default" name="free-btn">Free</button>
                     <input type="checkbox" name="2" value="free" class="hidden form-control"/>
                        </span>

                         <span class="button-checkbox">
                     <button type="button" class="btn btn-checkbox" data-color="default" name="cultural-btn">Cultural</button>
                     <input type="checkbox" name="3" value="cultura" class="hidden form-control"/>
                        </span>

                         <span class="button-checkbox">
                     <button type="button" class="btn btn-checkbox" data-color="default" name="tematica-btn">Temática</button>
                     <input type="checkbox" name="4" value="tematica" class="hidden form-control"/>
                        </span>

                         <span class="button-checkbox">
                     <button type="button" class="btn btn-checkbox" data-color="default" name="infantil-btn">Infantil</button>
                     <input type="checkbox" name="5" value="infantil" class="hidden form-control"/>
                        </span>

                         <span class="button-checkbox">
                     <button type="button" class="btn btn-checkbox" data-color="default" name="religioso-btn">Religioso</button>
                     <input type="checkbox" name="6" value="religioso" class="hidden form-control"/>
                        </span>

                         <span class="button-checkbox">
                     <button type="button" class="btn btn-checkbox" data-color="default" name="+18-btn">+18</button>
                     <input type="checkbox" name="7" value="18" class="hidden form-control"/>
                        </span>

                         <span class="button-checkbox">
                     <button type="button" class="btn btn-checkbox" data-color="default" name="lgbts-btn">LGBTS</button>
                     <input type="checkbox" name="8" value="lgbts" class="hidden form-control"/>
                        </span>

                        <span class="button-checkbox">
                     <button type="button" class="btn btn-checkbox" data-color="default" name="lual-btn">Lual</button>
                     <input type="checkbox" name="9" value="lual" class="hidden form-control"/>
                        </span>


                         <span class="button-checkbox">
                     <button type="button" class="btn" data-color="default" name="show-btn">Show</button>
                     <input type="checkbox" name="10" value="show" class="hidden form-control"/>
                        </span>

                         <span class="button-checkbox">
                     <button type="button" class="btn btn-checkbox" data-color="default" name="bar">Bar</button>
                     <input type="checkbox" name="11" value="bar" class="hidden form-control"/>
                        </span>

                    </div>     

                <h4 class="page-header">Localização</h4>
           

                	<div class="form-group float-label-control" id="comp">
                        <label for="">Logradouro</label>
                        <input name="logradouro" type="text" class="form-control" placeholder="Logradouro" required>
                    </div>
                    <div class="form-group float-label-control">
                        <label for="">Número</label>
                        <input name="numero" type="text" class="form-control" placeholder="Número" maxlength="4" required>
                    </div>
                    <div class="form-group float-label-control">
                        <label for="">Complemento</label>
                        <input name="complemento" type="text" class="form-control" placeholder="Complemento">
                    </div>
                    <div class="form-group float-label-control">
                        <label for="">Bairro</label>
                        <input name="bairro" type="text" class="form-control" placeholder="Bairro" required>
                    </div>

                     <div class="form-group float-label-control">
                        <label for="">CEP</label>
                        <input name="cep" type="text" class="form-control" placeholder="CEP" required>
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
             <div class="form-group">
    					<input type="checkbox" name="confirmacao" required>
    					<label><h5>Li e concordo com os termos de serviço</h5></label>

    				</div>


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


</body>
</html>