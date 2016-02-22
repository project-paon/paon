<?php
include("connectionBDD.php");

$tweetID = $_POST['tweet_id'];
$pseudo = $_POST['pseudo'];

// $retweet = $_GET['id'];

$retweet = 2;

try {
 $copy = $bdd->query("SELECT * FROM tweets WHERE id = $retweet");
}
catch(Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.

{
 echo 'Une exception a été lancée. Message d\'erreur : ', $e->getMessage();
}

$result =  $copy->fetchAll();
$copy = $result[0]["rt_nb"];
$copy  += 1;  try {
   $bdd->query("UPDATE tweets SET rt_nb = $copy WHERE id = $retweet");
}
 catch(Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.
 {
   echo 'Une exception a été lancée. Message d\'erreur : ', $e->getMessage();
 }

 echo 'Fin du script'; // Ce message s'affiche, ça prouve bien que le script est exécuté jusqu'au bout.

 echo "$copy";


try {
 $bdd->query("INSERT INTO rt VALUES('','$tweetID','$pseudo')");
 echo ('{"statut":"true"}');
}
catch(Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.
{
  header('HTTP/1.1 400 crash BDD');
         die('Erreur : '.$e->getMessage());
       }

?>
