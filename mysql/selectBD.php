<?php

/******************************************************************************************
** COLOCAR "" NOS PARAMETROS DO $COD SE QUISER DAR SELECT EM TODOS CADASTRADOS DA TABELA **
******************************************************************************************/

function selectBD($valores, $tabela, $filtro, $cod){
	
	include("conexao.php");

	try {
		$id = $cod;

		$query = "select ".$valores." from ".$tabela." where 1=1";

		if(isset($id)){
			if($id!=""){
				$query = $query." and ".$filtro." = ?";
			}
		}

		$stmt = $conexao->prepare($query);
		$stmt->bindParam(1,$id);


		$stmt->execute();

		$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $retorno;
			
	} catch (PDOException $e) {
	echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
	</script>";
	echo "<script>window.location.replace('../../home.php');</script>";
	}
}