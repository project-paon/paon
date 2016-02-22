<?php

// On se connecte à la base de données.

include("connectionBDD.php");

// On déclare les variables.

$pseudo = $_POST['pseudo'];
$session = $_POST['session'];

// On récupère toutes les données de la table session.

try{
  $sessionTest =  $bdd->query("SELECT * FROM session where pseudo = '$pseudo'");
}catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

// On récupère les données sous forme de tableau dans la variable test.
$test = $sessionTest->fetchAll();

// On récupère le numéros de session
if($test[0]["session"] === $session){

  try{
// on récupère les données dans la table tweets dans une variable du même nom.
      $tweets = $bdd->query('SELECT pseudo, message, image, like_nb, rt_nb FROM tweets INNER JOIN users ON tweets.user_pseudo = users.pseudo');

    }
    catch(Exception $e)
    {
        header('HTTP/1.1 400 crash BDD');
        die('Erreur : '.$e->getMessage());
    }
    // Dans la variable output,
    $output ="[";
    // tant qu'il y a des données à intégrer au tableau,
    while ($resultat = $tweets->fetch()){
      $output .='{"pseudo":"'.$resultat['pseudo'].'","message":"'.$resultat['message'].'","image":"'.$resultat['image'].'","like_nb":"'.$resultat['like_nb'].'","rt_nb":"'.$resultat['rt_nb'].'"},';
      // on les lui insère,
    }; //puis on referme output.
    $output .="]";
    echo $output;

<<<<<<< HEAD
=======
// Sinon on déclare l'erreur.
>>>>>>> 7fa2a8e7562b1e72501d92ba19f3249ea7e79cb8

}else{

  header('HTTP/1.1 412 not connect');
  echo ('{"statut":"false","erreur" : "session expired"}');
}
?>
