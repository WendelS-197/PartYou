<?php
include("../conexao.php");
include("../verifica_start_session.php");

try {
	$senhaAntiga = strip_tags($_POST["senhaAtual"]);
	$senhaNova = password_hash(strip_tags($_POST["senha"]), PASSWORD_DEFAULT);

	$stmt= $conexao->prepare("select senha from usuario where id = ?");
	$stmt->bindParam(1,$_SESSION["id"]);

	$stmt->execute();

	$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if(sizeof($resultado) != 0){
		if(password_verify($senhaAntiga, $resultado[0]["senha"])){
			$stmt = $conexao->prepare("update usuario set senha = ? where id = ?");
			$stmt->bindParam(1, $senhaNova);
			$stmt->bindParam(2, $_SESSION["id"]);

			$stmt->execute();

			echo "<script>
					alert('Senha alterada com sucesso!');
					window.location.replace('../../editarUsuario.php');
				</script>";

		}else{

			echo "<script>
				alert('Senha atual incorreta, tente novamente!');
				window.location.replace('../../editarUsuario.php#trocarsenha');
			</script>";

		}

	}
	
} catch (PDOException $e) {
	echo "<script>
				alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
			</script>";
	echo "<script>window.location.replace('../../home.php');</script>";

}

?>