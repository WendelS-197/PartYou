<?php
	include("../conexao.php");
try{
	if(!isset($_SESSION)){
        session_start();
        if(isset($_SESSION["id"])){
        	if($_SESSION["usuario"] == $_POST["user"] or $_SESSION["tipo"] == "adm"){
	        	$stmt = $conexao->prepare("select nome_usuario, id from usuario where nome_usuario = ?");
				$stmt->bindParam(1,$_POST["user"]);

				$stmt->execute();

				$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$deletar = $conexao->prepare("delete from usuario where nome_usuario = ?");
				$deletar->bindParam(1,$resultado[0]["nome_usuario"]);
				$deletar->execute();

				$deletar = $conexao->prepare("delete from endereco where id = ?");
				$deletar->bindParam(1,$resultado[0]["id"]);
				$deletar->execute();
			if($_SESSION["usuario"] == $_POST["user"]){
				session_destroy();
        		echo "<script>alert('Usuario deletado com sucesso!') </script>";
				echo "<script>window.location.replace('../../home.php')</script>";
			}else{

				echo "<script>alert('Usuario deletado com sucesso!') </script>";
				echo "<script>window.location.replace('../../home.php')</script>";
			}
			}else{
				echo "<script>alert('Você não tem permissões necessarios para deletar um usuario') </script>";
				echo "<script>window.location.replace('../../home.php')</script>";
        	}
    	}
	}
}catch (PDOException $e) {
	echo $e->getMessage();

	/*echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
	</script>";
	echo "<script>window.location.replace('../../home.php');</script>"; */
}
?>