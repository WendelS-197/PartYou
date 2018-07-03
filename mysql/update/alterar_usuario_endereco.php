<?php
include("../conexao.php");
include("../verifica_start_session.php");
include("../CN.php");

try {
	
	$nascimento = dataProBanco($_POST["dataNasc"]);

	$stmt = $conexao->prepare("update usuario set nome = ?, data_nascimento =?, telefone =?, email =?, descricao =? where id =? ");

	$stmt->bindValue(1,strip_tags($_POST["nome"]));
	$stmt->bindParam(2,$nascimento);
	$stmt->bindValue(3,strip_tags($_POST["telefone"]));
	$stmt->bindValue(4,strip_tags($_POST["email"]));
	$stmt->bindValue(5,strip_tags($_POST["descricao"]));
	$stmt->bindParam(6,$_SESSION["id"]);

	$stmt->execute();

	$stmt = $conexao->prepare("update endereco set logradouro = ? , numero = ?, bairro = ?, cep = ?, complemento = ?, uf= ?, cidade = ?   where id = ?");

	$stmt->bindValue(1,strip_tags($_POST["logradouro"]));
	$stmt->bindValue(2,strip_tags($_POST["numero"]));
	$stmt->bindValue(3,strip_tags($_POST["bairro"]));
	$stmt->bindValue(4,strip_tags($_POST["cep"]));
	$stmt->bindValue(5,strip_tags($_POST["complemento"]));
	$stmt->bindParam(6,$_POST["estado"]);
	$stmt->bindParam(7,$_POST["cidade"]);
	$stmt->bindParam(8,$_SESSION["id"]);

	$stmt->execute();

	echo "<script>alert('Informações alteradas com sucesso!');</script>";
	echo "<script>window.location.replace('../../perfil.php?user=".$_SESSION["usuario"]."');</script>";

} catch (PDOException $e) {
	echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
	</script>";
	echo "<script>window.location.replace('../../home.php');</script>";
}
?>