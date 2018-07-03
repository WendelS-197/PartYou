<?php
include("conexao.php");
include("CN.php");

try {

  $nomeEvento = separarNomeEvento($_GET["evento"]);
  $stmt = $conexao->prepare("select nome from evento where nome = ?;");
  $stmt->bindParam(1, $nomeEvento);

  $stmt->execute();
  $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); 

  if(sizeof($resultado) != 0){

  $stmt = $conexao->prepare("select evento.id as evento_id, evento.nome, categoria1, categoria2, categoria3, nome_usuario, evento.descricao, informacao, data_inicio_evento, data_final_evento, hora_inicio_evento, hora_final_evento, fotoevento, logradouro, numero, bairro, cidade, uf from evento inner join localizacao,usuario where usuario.id = evento.id_usuario and evento.nome = ? and localizacao.id = evento.id_localizacao;");

  $nomeEvento = separarNomeEvento($_GET["evento"]);

  $stmt->bindParam(1, $nomeEvento);

  $stmt->execute();
  $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); 

  if(sizeof($resultado) != 0){
    foreach ($resultado as $linha) {

      $id_evento = $linha["evento_id"];
      $endereco = $linha["logradouro"].", ".$linha["numero"]." - ".$linha["bairro"].", ";
      $endereco = $endereco.$linha["uf"].", ".$linha["cidade"];
      $dataInicio = dataProUsuario($linha["data_inicio_evento"]);
      $dataFim = dataProUsuario($linha["data_final_evento"]);
      $categorias = $linha["categoria1"]." ".$linha["categoria2"]." ".$linha["categoria3"];
      $fotoevento = "imagens/eventos/".$linha["fotoevento"];
      
    }
 
  }


  $stmt = $conexao->prepare("select conteudo, nome_usuario, nome, foto from comentario inner join usuario where comentario.id_evento = ? and usuario.id = comentario.id_usuario;");

  $idEvento = pegarIdPorNome("id", "evento", separarNomeEvento($_GET["evento"]));

  $stmt->bindParam(1, $idEvento);

  $stmt->execute();
  $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC); 

  }else{

    echo "<script>alert('Essa página não existe!');</script>";
    echo "<script>window.location.replace('home.php');</script>";

  }


} catch (PDOException $e) {
  echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
  </script>";
  echo "<script>window.location.replace('../../home.php');</script>";
}     
?>