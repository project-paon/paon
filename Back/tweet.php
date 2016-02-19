<?php
include("connectionBDD.php");

$pseudo = $_POST['pseudo'];
$session = $_POST['session'];
$message = $_POST['message'];


if(strlen ($message) <= 140 ){

  try{
    $sessionTest =  $bdd->query("SELECT * FROM session where pseudo = '$pseudo'");
  }catch(Exception $e)
  {
      die('Erreur : '.$e->getMessage());
  }

  $test = $sessionTest->fetchAll();

  if($test[0]["session"] === $session){
      try{
          $bdd->query("INSERT INTO tweets VALUES('','$pseudo', '$message','','')");
          header('HTTP/1.1 201 OK');
          echo ('{"statut":"true"}');
      }catch(Exception $e)
      {
          die('Erreur : '.$e->getMessage());
      }
  }else{
      header('HTTP/1.1 412 not connect');
      echo ('{"statut":"false","erreur" : "session expired"}');
  }



}else {
    header('HTTP/1.1 412 too long');
    echo ('{"statut":"false","erreur" : "message trop long"}');

}

?>
