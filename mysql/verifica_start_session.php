<?php
if(!isset($_SESSION)){
      session_start();
      
      if(!isset($_SESSION["id"])){
        session_destroy();
        echo "<script>window.location.replace('home.php');</script>";
      }
}
?>