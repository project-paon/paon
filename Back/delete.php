<?php

// On se connecte à la base de données.
include("connectionBDD.php");

// On déclare nos variables. Le htmlspecialchars sert à modifié les caractères spéciaux pour le HTML.

// $pseudo = htmlspecialchars($_POST['pseudo']);
// $session =$_POST['session'];

$pseudo = $_COOKIE['pseudo'];
$session = $_COOKIE['session'];

// On sélectionne les données que l'on souhaite dans la base de données. Si ça ne fonctionne pas on envoit un message d'erreur et on kill la connection.


// On récupère les numéros de session dans la table "session".

try{
    $testUsers = $bdd->query("SELECT session FROM session WHERE pseudo = '$pseudo'");
}catch(Exception $e)
{
  header('HTTP/1.1 400 crash BDD');
    die('Erreur : '.$e->getMessage());
}

// On récupère toutes les données sous forme de tableau avec fetchAll.

$test = $testUsers->fetchAll();

// On compare les numéros de session

if($test[0][0]=== $session){
// On déclare une variable qui récupère l'ID du tweet.

$detweet = $_DELETE['id'];
  try {
   $bdd->query("DELETE FROM tweets WHERE id = $detweet");
   echo ('{"statut":"true"}');
}
 catch(Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.
 {
   header('HTTP/1.1 400 crash BDD');
          die('Erreur : '.$e->getMessage());
         }
}
else {
  echo ('{"statut":"false","erreur" : "Vous n\'avez pas le droit de supprimer ce tweet ", "type":"2"}');
     header('HTTP/1.1 401 Non autorisé');
   }
