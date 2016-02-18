<?php
include("connectionBDD.php");

$pseudo = $_POST['pseudo'];
//$session
$message = $_POST['message'];

if(strlen ($message) > 140 ){

  try{
      $bdd->query("INSERT INTO tweets VALUES('',$pseudo, $message,'','')");
      header('HTTP/1.1 201 OK');
      echo json_encode('{"statut":"true"}');
  }catch(Exception $e)
  {
      die('Erreur : '.$e->getMessage());
  }

}else {
    header('HTTP/1.1 412 too long');
    echo json_encode('{"statut":"false","erreur" : "message trop long"}');

}

?>
