<?php
include("connectionBDD.php");

$pseudo = htmlspecialchars($_POST['pseudo']);
$session =$_POST['session'];

try{
    $testUsers = $bdd->query("SELECT session FROM session WHERE pseudo = '$pseudo'");
}catch(Exception $e)
{
  header('HTTP/1.1 400 crash BDD');
    die('Erreur : '.$e->getMessage());
}

$test = $testUsers->fetchAll();

if($test[0][0]=== $session){
// $detweet = $_DELETE['id'];
$detweet = 2;
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

?>
