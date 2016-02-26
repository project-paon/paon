<?php

// On se connecte à la base de données.

include("connectionBDD.php");

// On déclare une variable qui récupère l'ID du tweet.

$potweet = $_PUT['id'];
$pseudo = $_COOKIE['pseudo'];
$session = $_COOKIE['session'];

  try {
   $tolike = $bdd->query("SELECT like_nb FROM tweets WHERE id = $potweet");
  }
  catch(Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.

  {
   echo 'Une exception a été lancée. Message d\'erreur : ', $e->getMessage();
  }

//Déclaration des variables et on ajoute +1 au compteur de like à chaque clic.

  $result = $tolike->fetchAll();
  $tolike = $result[0]["like_nb"];
  $tolike  += 1;

// on met à jour les données de la table tweet. Avec l'incrémentation.
  try {
   $bdd->query("UPDATE tweets SET like_nb = $tolike WHERE id = $potweet");
}
 catch(Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.
 {
   echo 'Une exception a été lancée. Message d\'erreur : ', $e->getMessage();
 }

 echo 'Fin du script'; // Ce message s'affiche, ça prouve bien que le script est exécuté jusqu'au bout.
 echo "$tolike";
