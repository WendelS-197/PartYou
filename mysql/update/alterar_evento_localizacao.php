<?php
include("../conexao.php");
include("../verifica_start_session.php");
include("../CN.php");

try {

	$dataInicio = dataProBanco($_POST["dataInicio"]);
    $dataFim = dataProBanco($_POST["dataFim"]);

    $categorias = array();
    for ($i=1; $i < 12; $i++) { 
        if(isset($_POST[$i])){
            array_push($categorias, $_POST[$i]);
        }
    }
    if (count($categorias) == 2) {
        array_push($categorias, null);
    }else if (count($categorias) == 1) {
        array_push($categorias, null);
        array_push($categorias, null);
    }
    $evento = separarNomeEvento($_GET["evento"]);
  	
  	$id = pegarIdPorNome("id", "evento", $evento);
	$nome = separarNomeEvento($_POST["nome"]);

	$stmt = $conexao->prepare("update evento set nome = ?, data_inicio_evento =?, data_final_evento =?, hora_inicio_evento=?, hora_final_evento=?, descricao =?, informacao=?, categoria1=?, categoria2=?, categoria3=? where nome =? ");

	$stmt->bindValue(1,strip_tags($nome));
	$stmt->bindParam(2,$dataInicio);
	$stmt->bindParam(3,$dataFim);
	$stmt->bindParam(4,$_POST["horaInicio"]);
	$stmt->bindParam(5,$_POST["horaFim"]);
	$stmt->bindValue(6,strip_tags($_POST["descricao"]));
	$stmt->bindValue(7,strip_tags($_POST["informacao"]));
	$stmt->bindParam(8,$categorias[0]);
	$stmt->bindParam(9,$categorias[1]);
	$stmt->bindParam(10,$categorias[2]);
	$stmt->bindParam(11,$evento);

	$stmt->execute();
	
	$_SESSION["nome"] = $_POST["nome"];

	$stmt = $conexao->prepare("update localizacao set logradouro = ? , numero = ?, bairro = ?, cep = ?, complemento = ?, uf= ?, cidade = ? where id = ?");

	$stmt->bindValue(1,strip_tags($_POST["logradouro"]));
	$stmt->bindValue(2,strip_tags($_POST["numero"]));
	$stmt->bindValue(3,strip_tags($_POST["bairro"]));
	$stmt->bindValue(4,strip_tags($_POST["cep"]));
	$stmt->bindValue(5,strip_tags($_POST["complemento"]));
	$stmt->bindParam(6,$_POST["estado"]);
	$stmt->bindParam(7,$_POST["cidade"]);
	$stmt->bindParam(8,$id);

	$stmt->execute();

	echo "<script>alert('Informações alteradas com sucesso!');</script>";
	echo "<script>window.location.replace('../../evento.php?evento=".juntarNomeEvento($_POST["nome"])."');</script>";
} catch (PDOException $e) {
	echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
	</script>";
	echo "<script>window.location.replace('../../home.php');</script>";
}
?>