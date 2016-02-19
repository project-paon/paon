<?php
include("connectionBDD.php");

// $detweet = $_DELETE['id'];

$detweet = 2;

  try {
   $tolike = $bdd->query("SELECT * FROM tweets WHERE id = $detweet");
  }
  catch(Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.

  {
   echo 'Une exception a été lancée. Message d\'erreur : ', $e->getMessage();
  }

  try {
   $bdd->query("DELETE FROM tweets WHERE id = $detweet");
}
 catch(Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.
 {
   echo 'Une exception a été lancée. Message d\'erreur : ', $e->getMessage();
 }

 echo 'Fin du script'; // Ce message s'affiche, ça prouve bien que le script est exécuté jusqu'au bout.


?>
