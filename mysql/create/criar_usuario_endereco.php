<?php
include("../conexao.php");
include("../CN.php");

if(verificarNomeUsuario($_POST['nomeUsuario']) == False){

	echo "<script>alert('Nome de usuario ja registrado, utilize outro!');</script>";
	echo "<script>window.history.go(-1);</script>";

}
else if(verificarEmail($_POST['email']) == False){

	echo "<script>alert('Email ja registrado, utilize outro!');</script>";
	echo "<script>window.history.go(-1);</script>";

}
else{

	$data = dataProBanco($_POST["dataNasc"]);
	$senha = password_hash(strip_tags($_POST["senha"]), PASSWORD_DEFAULT);

	try {
	
		$stmt= $conexao->prepare("insert into endereco(cep, numero, logradouro, complemento, uf, cidade, bairro) values(?,?,?,?,?,?,?);");

		$stmt->bindValue(1,strip_tags($_POST["cep"]));
		$stmt->bindValue(2,strip_tags($_POST["numero"]));
		$stmt->bindValue(3,strip_tags($_POST["logradouro"]));
		$stmt->bindValue(4,strip_tags($_POST["complemento"]));
		$stmt->bindValue(5,strip_tags($_POST["estado"]));
		$stmt->bindValue(6,strip_tags($_POST["cidade"]));
		$stmt->bindValue(7,strip_tags($_POST["bairro"]));


		$stmt->execute();

		$id_endereco = $conexao->prepare("select max(id) from endereco");
		$id_endereco->execute();
		$resultado = $id_endereco->fetch();

		$stmt= $conexao->prepare("insert into usuario(nome, nome_usuario, senha, data_nascimento, telefone, email, adm, descricao, id_endereco, foto, capa) values(?,?,?,?,?,?,?,?,?,?,?);");

		$stmt->bindValue(1,strip_tags($_POST["nome"]));
		$stmt->bindValue(2,strip_tags($_POST["nomeUsuario"]));
		$stmt->bindParam(3,$senha);
		$stmt->bindParam(4,$data);
		$stmt->bindValue(5,strip_tags($_POST["telefone"]));
		$stmt->bindValue(6,strip_tags($_POST["email"]));
		$stmt->bindValue(7,"comum");
		$stmt->bindValue(8,strip_tags($_POST["descricao"]));
		$stmt->bindParam(9,$resultado[0]);
		$stmt->bindValue(10,"user.png");
		$stmt->bindValue(11,"capa.jpg");

		$stmt->execute();

		echo "<script>window.location.replace('../../index.php')</script>";
	}catch(PDOException $e){
		echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
		</script>";
		echo "<script>window.location.replace('../../home.php');</script>";
	}
}