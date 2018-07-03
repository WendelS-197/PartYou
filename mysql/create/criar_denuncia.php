<?php
include("../verifica_start_session.php");
include("../conexao.php");
include("../CN.php");

try {

	if(verificarNomeEvento($_POST["nome"]) == false || verificarNomeUsuario($_POST["nome"]) == false){

		$stmt = $conexao->prepare("insert into denuncia(tipo, nome, descricao, id_usuario) values(?,?,?,?);");
	
		$stmt->bindParam(1,$_POST["tipo"]);
		$stmt->bindValue(2,strip_tags($_POST["nome"]));
		$stmt->bindValue(3,strip_tags($_POST["descricao"]));
		$stmt->bindParam(4,$_SESSION["id"]);

		$stmt->execute();

		echo "<script>alert('Denuncia realizada com sucesso!');</script>";
		echo "<script>window.location.replace('../../home.php');</script>";
	}else{
		echo "<script>
				alert('Evento ou usuário não existe, insira um válido');
				window.history.go(-1);
			</script>";

	}
} catch (PDOException $e) {
	echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
	</script>";
	echo "<script>window.location.replace('../../home.php');</script>";
}


?>