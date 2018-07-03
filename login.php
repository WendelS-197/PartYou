<?php
	$login = strip_tags($_POST["usuario"]);
	$senha = strip_tags($_POST["senha"]);

	try{
		include("mysql/conexao.php");

		$stmt= $conexao->prepare("select * from usuario where nome_usuario = ?");
		$stmt->bindParam(1,$login);

		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(sizeof($resultado) != 0){
			foreach ($resultado as $linha) {
				if (password_verify($senha, $linha["senha"])){

					if(!isset($_SESSION)){
						session_start();
					}
					$_SESSION["usuario"] = $linha["nome_usuario"];
					$_SESSION["id"] = $linha["id"];
					$_SESSION["tipo"] = $linha["adm"];
					
				    echo "<script>window.location.replace('perfil.php?user=".$_SESSION["usuario"]."');</script>";

				}else { 
            		echo "<script>alert('Senha ou usuário incorreto');</script>";
            		echo "<script>window.location.replace('index.php#abrirmodal');</script>";
            	}
        	} 
        }else { 
            echo "<script>alert('Senha ou usuário incorreto');</script>";
            echo "<script>window.location.replace('index.php#abrirmodal');</script>";
        }

}
	catch(PDOException $e){
		echo "<script>
				alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
			</script>";
		echo "<script>window.location.replace('../../home.php');</script>";
	}
?>