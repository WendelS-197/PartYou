<?php
include("conexao.php");
include("selectBD.php");
include("CN.php");
    
try {
  //ABAIXO O CODIGO PARA OBTER AS INFORMAÇÕES CONTIDAS NA PÁGINA
  $resultado = selectBD("nome, descricao, data_nascimento, uf, cidade", "usuario inner join endereco", "nome_usuario", $_GET["user"]);

  if(sizeof($resultado) != 0){
    foreach ($resultado as $linha) {
      $nome = $linha["nome"];
      $descricao = $linha["descricao"];
      $nascimento = dataProUsuario($linha["data_nascimento"]);
      $endereco = $linha["uf"].", ".$linha["cidade"];
    }

    //ABAIXO O CODIGO PARA PEGAR FOTO E CAPA DO USUARIO
    $query = "select foto, capa from usuario where nome_usuario = ?";
    $stmt= $conexao->prepare($query);
    $stmt->bindParam(1,$_GET["user"]);
    
    $stmt->execute();

    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $foto = "imagens/perfil/".$resultado[0]["foto"];
    $capa = "imagens/capa/".$resultado[0]["capa"];

    //ABAIXO O CODIGO PARA TRAZER INFORMAÇÕES DOS EVENTOS CRIADOS PELO USUARIO

    $id_user = pegarIdPorNome("id", "usuario", $_GET["user"]);
    $stmt = $conexao->prepare("select fotoevento, nome from evento where id_usuario = ?");
    $stmt->bindParam(1, $id_user);

    $stmt->execute();

    $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

  }else{
    echo "<script>alert('Essa página não existe!');</script>";
    echo "<script>window.location.replace('perfil.php?user=".$_SESSION["usuario"]."');</script>";
  }


   
  
} catch (PDOException $e) {
  echo "<script>alert('Ocorreu um erro no sistema! Será resolvido em breve, tente novamente mais tarde!');
  </script>";
  echo "<script>window.location.replace('../../home.php');</script>";
}
    

?>