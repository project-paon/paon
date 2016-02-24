<?php

// On se connecte à la base de données.
include("connectionBDD.php");

// On déclare les variables qui récupère les données entrées par l'utilisateur.
// $pseudo = $_POST['pseudo'];
// $session = $_POST['session'];
$pseudo = $_COOKIE['pseudo'];
$session = $_COOKIE['session'];
$message = $_POST['message'];

// On oblige l'utilisateur à envoyer un message de maximum 140 caractères.
if(strlen ($message) <= 140 ){

  try{
    // On récupère toutes les données de la table session.
    $sessionTest =  $bdd->query("SELECT * FROM session where pseudo = '$pseudo'");
  }catch(Exception $e)
  {
      die('Erreur : '.$e->getMessage());
  }

// On récupère les données sous forme de tableau avec fetchAll dans la variable test.
  $test = $sessionTest->fetchAll();
  if($test[0]["session"] === $session){
      try{
        // On insère ses données dans la tablea tweets.
          $bdd->query("INSERT INTO tweets VALUES('','$pseudo', '$message','','')");
          header('HTTP/1.1 201 OK');
          echo ('{"statut":"true"}');
      }
      catch(Exception $e)
      {
          die('Erreur : '.$e->getMessage());
      }
  }
  else {
      header('HTTP/1.1 412 not connect');
      echo ('{"statut":"false","erreur" : "session expired"}');
  }
}
else {
    header('HTTP/1.1 412 too long');
    echo ('{"statut":"false","erreur" : "message trop long"}');
}
