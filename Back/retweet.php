<?php
include("connectionBDD.php");

$tweetID = $_POST['tweet_id'];
$pseudo = $_POST['pseudo'];
$pseudo = $_COOKIE['pseudo'];
$session = $_COOKIE['session'];

// $retweet = $_GET['id'];

$retweet = $tweetID;



try{
    // On récupère toutes les données de la table session.
    $sessionTest =  $bdd->query("SELECT * FROM session where pseudo = '$pseudo'");
}catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$result =  $copy->fetchAll();
$copy = $result[0]["rt_nb"];
$copy  += 1;

 try {
   $bdd->query("UPDATE tweets SET rt_nb = $copy WHERE id = $retweet");
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
  }else {
     header('HTTP/1.1 412 not connect');
     echo ('{"statut":"false","erreur" : "session expired"}');
  }
