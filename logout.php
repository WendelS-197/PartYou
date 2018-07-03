<?php
  if(!isset($_SESSION))
	session_start();

  unset($_SESSION["usuario"]);
  unset($_SESSION["id"]);
  unset($_SESSION["tipo"]);
  session_destroy();

  echo "<script>window.location.replace('index.php');</script>";
?>