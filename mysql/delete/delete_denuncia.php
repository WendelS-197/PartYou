<?php
include("../verifica_start_session.php");
include("../conexao.php");

try {

	$stmt = $conexao->prepare("delete from denuncia where id = ?");
	$stmt->bindParam(1, $_POST["deletar"]);

	$stmt->execute();

	echo "<script>window.location.replace('../../analiseDenuncia.php')</script>";
	
}catch (PDOException $e) {
	echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
	</script>";
	echo "<script>window.location.replace('../../home.php');</script>";
}

?>