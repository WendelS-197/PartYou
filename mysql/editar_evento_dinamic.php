<?php
include("conexao.php");
include("CN.php");
try {
    $nomeEvento = separarNomeEvento($_GET["idEvento"]);

    $stmt = $conexao->prepare("select evento.nome, nome_usuario, evento.descricao, informacao, data_inicio_evento, data_final_evento, hora_inicio_evento, hora_final_evento, logradouro, numero, bairro, cidade, uf, complemento, cep from evento inner join localizacao,usuario where usuario.id = evento.id_usuario and evento.nome =? and localizacao.id = evento.id_localizacao;");


        $stmt->bindParam(1, $nomeEvento);

        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(sizeof($resultado) != 0){
          foreach ($resultado as $linha) {
            $dataInicio = dataProUsuario($linha["data_inicio_evento"]);
            $dataFim = dataProUsuario($linha["data_final_evento"]);
         }
        }
}catch (PDOException $e) {
    echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
    </script>";
    echo "<script>window.location.replace('../../home.php');</script>";
}
?>