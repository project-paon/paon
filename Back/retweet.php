<?php
include("connectionBDD.php");

// $retweet = $_GET['id'];

$retweet = 2;

try {
 $tolike = $bdd->query("SELECT * FROM tweets WHERE id = $retweet");
}
catch(Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.

{
 echo 'Une exception a été lancée. Message d\'erreur : ', $e->getMessage();
}
