<?php
include("connectionBDD.php");

// $pseudo = htmlspecialchars($_POST['pseudo']);
// $session =$_POST['session'];

$pseudo = 'Jula_Croft';
$session = '9a3fa79f5328b2f';

try{
    $testUsers = $bdd->query("SELECT session FROM session WHERE pseudo = '$pseudo'");
}catch(Exception $e)
{
  header('HTTP/1.1 400 crash BDD');
    die('Erreur : '.$e->getMessage());
}

$test = $testUsers->fetchAll();

try {
 $bdd->query("DELETE FROM session WHERE session = '$session'");
 echo ('{"statut":"true"}');
}
catch(Exception $e) // Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.
{
 header('HTTP/1.1 400 crash BDD');
        die('Erreur : '.$e->getMessage());
       }

?>
