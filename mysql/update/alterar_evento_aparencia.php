<?php 
include("../conexao.php");
include("../CN.php");

if(!isset($_SESSION)){
      session_start();
      
    if(!isset($_SESSION["id"])){
        session_destroy();
        echo "<script>alert('Apenas o criador do evento pode edita-lo!');</script>";
        echo "<script>window.history.go(-2);</script>";
    }else{
    	$nome = separarNomeEvento($_POST["nome"]);
    	$stmt = $conexao -> prepare("select id_usuario from evento where nome = ?;");
        $stmt->bindParam(1,$nome);

        $stmt->execute();

        $id_usuario = $stmt->fetch();
        if ($id_usuario[0] != $_SESSION["id"]) {
            echo "<script>alert('Apenas o criador do evento tem permissão para edita-lo'); </script>";
            echo "<script>window.location.replace('../../home.php')</script>";
        }else{
	        	try {
					$evento = separarNomeEvento($_POST["nome"]);

					$id = pegarIdPorNome("id","evento",$evento);

					$fotoevento = "";
					$fotoeventoArr = "";

					$destinoFotoevento = __DIR__."/../../imagens/eventos";


					if(isset($_FILES["fotoEvento"])){
						$fotoeventoArr = $_FILES["fotoEvento"];
						if(strcasecmp($fotoeventoArr["name"], "") != 0){
							if((strcasecmp($fotoeventoArr["type"], "image/jpeg") != 0 ) && (strcasecmp($fotoeventoArr["type"], "image/png") != 0)){
								echo "<script>
										alert('Tipo de foto de evento inválida');
										window.location.replace('../../evento.php#abirEdicao');
									  </script>";
							}else{
								$extensao = (strcasecmp($fotoeventoArr["type"], "image/jpeg") == 0?".jpg":".png");
								$fotoevento = $id."_evento".$extensao;
								move_uploaded_file($fotoeventoArr['tmp_name'],$destinoFotoevento. '/' .$fotoevento);

								$stmt = $conexao->prepare("update evento set fotoevento = ? where id = ?");

								$stmt->bindParam(1,$fotoevento);
								$stmt->bindParam(2,$id);
								$stmt->execute();
							}
						}
					}

					echo "<script>
							window.location.replace('../../evento.php?evento=".juntarNomeEvento($evento)."');
						</script>";
						
						
				}catch (PDOException $e) {
					echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');</script>";
					echo "<script>window.location.replace('../../home.php');</script>";
				}
        
        }
   	}
}


?> 