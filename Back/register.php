<?php

// On se connecte à la base de données.

include('connectionBDD.php');


// Quand on clic sur submit...
   if (isset($_POST['submit'])) {

       // On déclare nos variables. Le htmlspecialchars sert à modifié les caractères spéciaux pour le HTML.

     $pseudo=htmlspecialchars($_POST['pseudo']);
     $name=htmlspecialchars($_POST['name']);
     $firstname=htmlspecialchars($_POST['firstname']);
     $email=htmlspecialchars($_POST['email']);
     $password=htmlspecialchars($_POST['password']);
     $img=htmlspecialchars($_POST['img']);

     // Récupérations des données de la table users.

     try {
        $testPseudo = $bdd->query("SELECT * FROM users WHERE pseudo = '$pseudo'");
    }
    catch(Exception $e)
    {
        header('HTTP/1.1 400 crash BDD');
        die('Erreur : '.$e->getMessage());
    }

    // On récupère toutes les données sous forme de tableau avec fetchAll.
      $test = $testPseudo->fetchAll();
// On vérifie que le pseudo n'existe pas déjà dans la base de données.
  if ($test->rowCount() > 0){
        header('HTTP/1.1 422 pseudo already taken');
        echo ('{"statut":"false","erreur" : "'.$pseudo.' déjà utilisé", "type":"1"}');
  }

  // On vérifie que l'email est valide avec FILTER_VALIDATE_EMAIL.

  elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo ('{"statut":"false","erreur" : "Adresse email invalid.", "type":"2"}');
    header('HTTP/1.1 422 invalid email');
  }

  // On oblige les utilisateurs à avoir un mot de passe avec au moins 8 caractères.
  elseif(strlen($password) < 8){
      echo ('{"statut":"false","erreur" : "Mot de passe trop court.", "type":"3"}');
      header('HTTP/1.1 422 to short password');
  }
  else {

    // Quand toutes les conditions sont remplies. On crypte le mot de passe avec sha1...
    $passwordcrypt=sha1($password);
    // et on insère les données dans la base de données.
    $bdd->query("INSERT INTO users VALUES('$pseudo','$name','$firstname','$email','$passwordcrypt','$img')");
    header('HTTP/1.1 201 OK');
    $session = generateUniqueId(15) ;
    echo ('{"statut":"true","pseudo":"'.$pseudo.'","session":"'.$session.'"}');
  }
}
else {
  header("HTTP/1.1 400 $pseudo");
}

// Fonction qui génère un numéro de session unique.
function generateUniqueId($maxLength = null) {
    $entropy = '';

    // On test le ssl.
    if (function_exists('openssl_random_pseudo_bytes')) {
        $entropy = openssl_random_pseudo_bytes(64, $strong);
        if($strong !== true) {
            $entropy = '';
        }
    }

    // on ajoute les basic mt_rand/uniqid combo.

    $entropy .= uniqid(mt_rand(), true);

    // On essaye de lire la fenêtre RNG.
    if (class_exists('COM')) {
        try {
            $com = new COM('CAPICOM.Utilities.1');
            $entropy .= base64_decode($com->GetRandom(64, 0));
        } catch (Exception $ex) {
        }
    }

    // On essaye de lire unix RNG.
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


?>
