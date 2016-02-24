<?php

// On se connecte à la base de données.

include("connectionBDD.php");

// On déclare les variables.

$pseudo = $_COOKIE['pseudo'];
$session = $_COOKIE['session'];

// $pseudo = $_POST['pseudo'];
// $session = $_POST['session'];



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
      $tweets = $bdd->query('SELECT pseudo, message, image, like_nb, rt_nb, id FROM tweets INNER JOIN users ON tweets.user_pseudo = users.pseudo');

    }
    catch(Exception $e)
    {
        header('HTTP/1.1 400 crash BDD');
        die('Erreur : '.$e->getMessage());
    }
    //Création du tableaux output qui va recevoir les données,
    $output = array();
    while ($resultat = $tweets->fetch()){

      $tmp["pseudo"]=$resultat['pseudo'];
      $tmp["message"]=$resultat['message'];
      $tmp["image"]=$resultat['image'];
      $tmp["like_nb"]=$resultat['like_nb'];
      $tmp["rt_nb"]=$resultat['rt_nb'];

       // Remplissage avec un tableaux temporaire contenant les données du tweets
      array_push($output,$tmp);

    };
    $outputJson = json_encode($output);
    echo $outputJson;  //Exportation du tableau formater en JSON



// Sinon on déclare l'erreur.

}else{

  header('HTTP/1.1 412 not connect');
  echo ('{"statut":"false","erreur" : "session expired"}');
}
