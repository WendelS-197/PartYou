<?php
try{
	$conexao = new PDO('mysql:host=localhost;dbname=PartYou', "root");
	//$conexao = new PDO('mysql:host=localhost;dbname=PartYou', "root", "@luno1fpe");
	$conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch (PDOException $e) {
	echo "<script>alert('Ocorreu um erro de conexao no sistema! Será resolvido em breve, tente novamente mais tarde!');
	</script>";
	echo "<script>window.location.replace('../../home.php');</script>";
}
?>