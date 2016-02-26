<?php

// On se connecte à la base de données.

  include("connectionBDD.php");

  // On déclare nos variables. Le htmlspecialchars sert à modifié les caractères spéciaux pour le HTML.

  $pseudo = htmlspecialchars($_POST['pseudo']);
  $password =htmlspecialchars($_POST['password']);

  // On sélectionne les données que l'on souhaite dans la base de données. Si ça ne fonctionne pas on envoit un message d'erreur et on kill la connection.


  // On récupère les mots de passe par rapport aux pseudo dans la table "users".
   try{
       $testPseudo = $bdd->query("SELECT password FROM users WHERE pseudo = '$pseudo'");
   }catch(Exception $e)
   {
     header('HTTP/1.1 400 crash BDD');
       die('Erreur : '.$e->getMessage());
   }

// On récupère toutes les données sous forme de tableau avec fetchAll.
  $test = $testPseudo->fetchAll();

// On compare les mots de passe et pseudo par rapport à ceux de la base de données.
if($test[0][0]=== sha1($password)){
  $session = generateUniqueId(15) ;
  $bdd->query("DELETE FROM session WHERE pseudo = $pseudo");
  $bdd->query("INSERT INTO session VALUES ('','$pseudo','$session')");
  echo '{"statut":"true","pseudo":"'.$pseudo.'","session" : "'.$session.'"}';

  /*---------------------- Gestion des cookies  -----------------------------------------*/

  if(isset($_COOKIE[$pseudo])){
    unset($_COOKIE[$session]);
    unset($_COOKIE[$pseudo]);
  }

  setcookie("pseudo",$pseudo,time()+3600);
  setcookie("session",$session,time()+3600);

  /*---------------------- Fin de gestion des cookies -----------------------------------------*/



}else{
  echo ('{"statut":"false","erreur" : "Mot de passe invalide", "type":"3"}');
  header('HTTP/1.1 400 wrong password');
}



/*---------------------- FUNCTION de création de session -----------------------------------------*/

// Fonction qui crée un numéro de session unique.
function generateUniqueId($maxLength = null) {
    $entropy = '';

// On test ssl d'abord.
    if (function_exists('openssl_random_pseudo_bytes')) {
        $entropy = openssl_random_pseudo_bytes(64, $strong);
        // skip ssl since it wasn't using the strong algo
        if($strong !== true) {
            $entropy = '';
        }
    }

    // On ajoute les basics mt_rand/uniqid combo
    $entropy .= uniqid(mt_rand(), true);

    // On test la lecture de la fenêtre RNG
    if (class_exists('COM')) {
        try {
            $com = new COM('CAPICOM.Utilities.1');
            $entropy .= base64_decode($com->GetRandom(64, 0));
        } catch (Exception $ex) {
        }
    }

    // on test la lecture de unix RNG
    if (is_readable('/dev/urandom')) {
        $h = fopen('/dev/urandom', 'rb');
        $entropy .= fread($h, 64);
        fclose($h);
    }

    $hash = hash('whirlpool', $entropy);
    if ($maxLength) {
        return substr($hash, 0, $maxLength);
    }
    return $hash;
}
