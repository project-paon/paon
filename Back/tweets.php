<?php
include("connectionBDD.php");

try
{
    $tweets = $bdd->query('SELECT * FROM tweets');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$resultat = $tweets->fetchAll();

echo json_encode($resultat);

?>
