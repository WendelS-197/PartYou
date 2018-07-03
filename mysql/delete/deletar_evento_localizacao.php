<?php
include("../conexao.php");
include("../CN.php");
try{
	if(!isset($_SESSION)){
        session_start();
        if(isset($_SESSION["id"])){
            $nome = separarNomeEvento($_GET["evento"]);
        	$stmt = $conexao -> prepare("select id_usuario from evento where nome = ?;");
        	$stmt->bindParam(1,$nome);

        	$stmt->execute();

        	$id_usuario = $stmt->fetch();
            if ($id_usuario[0] != $_SESSION["id"] and $_SESSION["tipo"] != "adm") {
                echo "<script>alert('Apenas o criador do evento tem permissão para exclui-lo'); </script>";
                echo "<script>window.location.replace('../../home.php')</script>";
            }else{
                $stmt = $conexao -> prepare("select id from evento where nome = ? and id_usuario = ?;");
                $stmt->bindParam(1,$nome);
                $stmt->bindParam(2,$id_usuario[0]);
                $stmt->execute();

                $id = $stmt->fetch();
                $deletar = $conexao->prepare("delete from evento where id = ?");
                $deletar->bindParam(1,$id[0]);
                $deletar->execute();

                $deletar = $conexao->prepare("delete from localizacao where id = ?");
                $deletar->bindParam(1,$id[0]);
                $deletar->execute();

                echo "<script>alert('Evento deletado com sucesso!') </script>";
                echo "<script>window.location.replace('../../home.php')</script>";
            }
        }else{
            echo "<script>alert('Apenas o criador do evento tem permissão para exclui-lo'); </script>";
            echo "<script>window.history.go(-2);</script>";
        }
    }
}catch (PDOException $e) {
    echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
    </script>";
    echo "<script>window.location.replace('../../home.php');</script>";
}
?>
