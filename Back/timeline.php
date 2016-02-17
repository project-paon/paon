<?php
include("connectionBDD.php");
​
try{
    $tweets = $bdd->query('SELECT * FROM tweets');
}
catch(Exception $e)
{
    header('HTTP/1.1 400 crash BDD');
    die('Erreur : '.$e->getMessage());
}
​
$resultat = $tweets->fetchAll();
​
echo json_encode($resultat); // Remplacer echo par la réponse
​
?>
