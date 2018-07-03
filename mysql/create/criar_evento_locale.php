<?php
    include("../conexao.php");
    include("../CN.php");
    include("../verifica_start_session.php");

    if(verificarNomeEvento($_POST['nome']) == False){

    echo "<script>alert('Nome de evento ja registrado, utilize outro!');</script>";
    echo "<script>window.history.go(-1);</script>";

    }else{

        if(!isset($_SESSION)){
            session_start();
        }
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


        $dataInicio = dataProBanco($_POST["dataInicio"]);
        $dataFim = dataProBanco($_POST["dataFim"]);

        try {

        	$stmt= $conexao->prepare("insert into localizacao(cep, numero, logradouro, complemento, uf, cidade, bairro) values(?,?,?,?,?,?,?);");

            $stmt->bindValue(1,strip_tags($_POST["cep"]));
            $stmt->bindValue(2,strip_tags($_POST["numero"]));
            $stmt->bindValue(3,strip_tags($_POST["logradouro"]));
            $stmt->bindValue(4,strip_tags($_POST["complemento"]));
            $stmt->bindParam(5,$_POST["estado"]);
            $stmt->bindParam(6,$_POST["cidade"]);
            $stmt->bindValue(7,strip_tags($_POST["bairro"]));

            $stmt->execute();

            $id_localizacao = $conexao->prepare("select max(id) from localizacao");
            $id_localizacao->execute();
            $resultado = $id_localizacao->fetch();

    		$stmt= $conexao->prepare("insert into evento(nome, data_inicio_evento, data_final_evento, descricao, informacao, hora_inicio_evento, hora_final_evento, categoria1, categoria2, categoria3, fotoevento, id_usuario, id_localizacao) values(?,?,?,?,?,?,?,?,?,?,?,?,?);");

    	    $stmt->bindValue(1,strip_tags($_POST["nome"]));
    	    $stmt->bindParam(2,$dataInicio);
    	    $stmt->bindParam(3,$dataFim);
    	    $stmt->bindValue(4,strip_tags($_POST["descricao"]));
            $stmt->bindValue(5,strip_tags($_POST["informacao"]));
    	    $stmt->bindParam(6,$_POST["horaInicio"]);
    	    $stmt->bindParam(7,$_POST["horaFim"]);
    	    $stmt->bindParam(8,$categorias[0]);
            $stmt->bindParam(9,$categorias[1]);
            $stmt->bindParam(10,$categorias[2]);
            $stmt->bindValue(11,"default.jpeg");
    	    $stmt->bindParam(12,$_SESSION["id"]);
    	    $stmt->bindParam(13,$resultado[0]);


       		$stmt->execute();
        	
            echo "<script>alert('Evento criado com sucesso!');</script>";
        	echo "<script>window.location.replace('../../evento.php?evento=".juntarNomeEvento($_POST["nome"])."');</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');</script>";
            echo "<script>window.location.replace('../../home.php');</script>";
        }
}
?>