<?php
include("connectionBDD.php");

$potweet = $_PUT['id'];

  try {
   $tolike = $bdd->query("SELECT like_nb FROM tweets WHERE id = $potweet");
  }
  catch(Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.

  {
   echo 'Une exception a été lancée. Message d\'erreur : ', $e->getMessage();
  }

  $result = $tolike->fetchAll();
  $tolike = $result[0]["like_nb"];
  $tolike  += 1;

  try {
   $bdd->query("UPDATE tweets SET like_nb = $tolike WHERE id = $potweet");
}
 catch(Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.
 {
   echo 'Une exception a été lancée. Message d\'erreur : ', $e->getMessage();
 }

 echo 'Fin du script'; // Ce message s'affiche, ça prouve bien que le script est exécuté jusqu'au bout.
 echo "$tolike";

?>
