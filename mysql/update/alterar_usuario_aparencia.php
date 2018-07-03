<?php
include("../verifica_start_session.php");
include("../conexao.php");
try {
	$fotoArr = "";
	$capaArr = "";
	$foto = "";
	$capa = "";

	$destinoFoto = __DIR__."/../../imagens/perfil";
	$destinoCapa = __DIR__."/../../imagens/capa";


	if(isset($_FILES["fotoPerfil"])){
		$fotoArr = $_FILES["fotoPerfil"];

		if(strcasecmp($fotoArr["name"], "") != 0){
			if((strcasecmp($fotoArr["type"], "image/jpeg") != 0 ) && (strcasecmp($fotoArr["type"], "image/png") != 0)){
			echo "<script>
					alert('Tipo de foto de perfil inválida');
					window.location.replace('../../perfil.php#abirEdicao');
				  </script>";

			}else{
				$extensao = (strcasecmp($fotoArr["type"], "image/jpeg") == 0?".jpg":".png");
				$foto = $_SESSION["id"]."_perfil".$extensao;
				move_uploaded_file($fotoArr['tmp_name'],$destinoFoto. '/' .$foto);

				$stmt = $conexao->prepare("update usuario set foto=? where id =?");

				$stmt->bindParam(1,$foto);
				$stmt->bindParam(2,$_SESSION["id"]);
				$stmt->execute();

			}
		}
	}



	if(isset($_FILES["fotoCapa"])){
		$capaArr = $_FILES["fotoCapa"];

		if(strcasecmp($capaArr["name"], "") != 0){
			if((strcasecmp($capaArr["type"], "image/jpeg") != 0 ) && (strcasecmp($capaArr["type"], "image/png") != 0)){
			echo "<script>
					alert('Tipo de foto de capa inválida');
					window.location.replace('../../perfil.php#abirEdicao');
				  </script>";
			}else{
				$extensao = (strcasecmp($capaArr["type"], "image/jpeg") == 0?".jpg":".png");
				$capa = $_SESSION["id"]."_capa".$extensao;
				move_uploaded_file($capaArr['tmp_name'],$destinoCapa. '/' .$capa);

				$stmt = $conexao->prepare("update usuario set capa=? where id =?");

				$stmt->bindParam(1,$capa);
				$stmt->bindParam(2,$_SESSION["id"]);
				$stmt->execute();
					
			}

		}
	}
	$usuario = $_SESSION["usuario"];
	echo "<script>
			window.location.replace('../../perfil.php?user=$usuario');
		</script>";
	

} catch (PDOException $e) {
	echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
	</script>";
	echo "<script>window.location.replace('../../home.php');</script>";
}

?>