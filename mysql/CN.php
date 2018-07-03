<?php 

//FUNÇÃO PARA CONVERTER O NOME DO EVENTO PARA FICAR COMPATÍVEL COM O BANCO DE DADOS
function separarNomeEvento($nome_evento){
		$arr = explode("-", $nome_evento);
		$arr = implode(" ", $arr);

	return $arr;
}

//FUNÇÃO PARA CONVERTER O NOME DO EVENTO PARA FICAR COMPATÍVEL COM O URL DO SITE	
function juntarNomeEvento($nome_evento){
		$arr = explode(" ", $nome_evento);
		$arr = implode("-", $arr);
			
	return $arr;
}


//FUNÇÃO ACIONA UM SELECT PRA PEGAR ID DE ALGUMA TABELA PELO NOME (UNIQUE)
function pegarIdPorNome($coluna, $tabela, $par){
	include("conexao.php");
    
    $query = "select ".$coluna." from ".$tabela." where ";
    
    if($tabela == "usuario"){
        $query = $query." nome_usuario = ?";
    }else{
        $query = $query." nome = ?";
    }

  	$stmt= $conexao->prepare($query);
    $stmt->bindParam(1,$par);

    $stmt->execute();

    $resultado = $stmt->fetch();

    return $resultado[0];
}

//FUNÇÃO PARA VERIFICAR SE O NOME DO USUARIO INSERIDO JA ESTÁ CADASTRADO
function verificarNomeUsuario($valor){
	include("conexao.php");
	$stmt= $conexao->prepare("select * from usuario where nome_usuario = ?");
    $stmt->bindParam(1,$valor);

    $stmt->execute();

    $resultado = $stmt->fetch();

    if ($resultado == "") {
    	return True;
    }else{
    	return False;
    }
}

//FUNÇÃO PARA VERIFICAR SE O EMAIL DE USUARIO INSERIDO JA ESTÁ CADASTRADO
function verificarEmail($valor){
	include("conexao.php");
	$stmt= $conexao->prepare("select * from usuario where email = ?");
    $stmt->bindParam(1,$valor);

    $stmt->execute();

    $resultado = $stmt->fetch();

    if ($resultado == "") {
    	return True;
    }else{
    	return False;
    }
}

//FUNÇÃO PARA VERIFICAR SE O NOME DE EVENTO INSERIDO JA ESTÁ CADASTRADO
function verificarNomeEvento($valor){
	include("conexao.php");
	$stmt= $conexao->prepare("select * from evento where nome = ?");
    $stmt->bindParam(1,$valor);

    $stmt->execute();

    $resultado = $stmt->fetch();
    if ($resultado == "") {
    	return True;
    }else{
    	return False;
    }
}

//FUNÇÃO PARA FORMATAR A DATA COMPATÍVEL AO BANCO
function dataProBanco($data){
    $data = explode("/", $data);
    $dataFormatada = $data[2]."-".$data[1]."-".$data[0];

    return $dataFormatada;
}

//FUNÇÃO PARA FOMATAR A DATA LEGÍVEL PARA O USUÁRIO
function dataProUsuario($data){
    $data = explode("-", $data);
    $dataFormatada = $data[2]."/".$data[1]."/".$data[0];

    return $dataFormatada;
}


//FUNÇÃO PARA TIRAR OS SEGUNDOS DO HORARIO DO EVENTO
function horarioEvento($hora){
    $hora = explode(":", $hora);
    $horaFormatada = $hora[0].":".$hora[1];

    return $horaFormatada;

}

//FUNÇÃO PRA RETORNAR O MÊS EM ESCRITO DO EVENTO
function mesEvento($data){
    $data = explode("/", $data);

    switch ($data[1]) {
        case '01':
            return "Jan";
        case '02':
            return "Fev";
        case '03': 
            return "Mar";
        case '04':
            return "Abr";
        case '05':
            return "Mai";
        case '06':
            return "Jun";
        case '07':
            return "Jul";
        case '08':
            return "Ago";
        case '09':
            return "Set";
        case '10':
            return "Out";
        case '11':
            return "Nov";
        case '12':
            return "Dez";
    }
}

//FUNÇÃO PRA RETORNAR SÓ O DIA DO EVENTO
function diaEvento($data){
    $data = explode("/", $data);

    return $data[0];
}

?>