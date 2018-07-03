<?php 

include("../conexao.php");
include("../CN.php");

try {

	$comentario = $_POST["comentario"];
	$id_evento = pegarIdPorNome("id", "evento", separarNomeEvento($_GET["evento"]));
	$id_user = pegarIdPorNome("id", "usuario", $_GET["user"]);

	$stmt = $conexao->prepare("insert into comentario(id_usuario, id_evento, conteudo) values(?,?,?);");

	$stmt->bindParam(1, $id_user);
	$stmt->bindParam(2, $id_evento);
	$stmt->bindValue(3,strip_tags($comentario));

	$stmt->execute();
	
	echo "<script>window.location.replace('../../evento.php?evento=".$_GET['evento']."');</script>";
} catch (PDOException $e) {
	echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
	</script>";
	echo "<script>window.location.replace('../../home.php');</script>";
}
?>