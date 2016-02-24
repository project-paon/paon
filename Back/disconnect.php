<?php
// On se connecte à la base de données
include("connectionBDD.php");

// On déclare nos variables. Le htmlspecialchars sert à modifié les caractères spéciaux pour le HTML.

// $pseudo = htmlspecialchars($_POST['pseudo']);
// $session =$_POST['session'];

$pseudo = $_COOKIE['pseudo'];
$session = $_COOKIE['session'];

// On récupère le numéro de session dans la table session.
try{
    $testUsers = $bdd->query("SELECT session FROM session WHERE pseudo = '$pseudo'");
}catch(Exception $e)
{
  header('HTTP/1.1 400 crash BDD');
    die('Erreur : '.$e->getMessage());
}

// On insère toutes les données sous forme de  tableau dans la variable test avec fetchAll.
$test = $testUsers->fetchAll();

try {
  //On supprime la session de la tablea du même nom.
 $bdd->query("DELETE FROM session WHERE session = '$session'");
 unset($_COOKIE[$session]);
 unset($_COOKIE[$pseudo]);

 echo ('{"statut":"true"}');
}
catch(Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.
{
 header('HTTP/1.1 400 crash BDD');
        die('Erreur : '.$e->getMessage());
}
