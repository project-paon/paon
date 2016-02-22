<?php
include("connectionBDD.php");

$pseudo = $_POST['pseudo'];
$session = $_POST['session'];


try{
  $sessionTest =  $bdd->query("SELECT * FROM session where pseudo = '$pseudo'");
}catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$test = $sessionTest->fetchAll();

if($test[0]["session"] === $session){


  try{

      $tweets = $bdd->query('SELECT pseudo, message, image, like_nb, rt_nb FROM tweets INNER JOIN users ON tweets.user_pseudo = users.pseudo');

    }
    catch(Exception $e)
    {
        header('HTTP/1.1 400 crash BDD');
        die('Erreur : '.$e->getMessage());
    }
    $output ="[";
    while ($resultat = $tweets->fetch()){
      $output .='{"pseudo":"'.$resultat['pseudo'].'","message":"'.$resultat['message'].'","image":"'.$resultat['image'].'","like_nb":"'.$resultat['like_nb'].'","rt_nb":"'.$resultat['rt_nb'].'"},';
    };
    $output .="]";
    echo $output;


}else{

  header('HTTP/1.1 412 not connect');
  echo ('{"statut":"false","erreur" : "session expired"}');
}
?>
