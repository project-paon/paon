<?php
include('connectionBDD.php');

   if (isset($_POST['submit'])) {
     // Création des variables
     $pseudo=htmlspecialchars($_POST['pseudo']);
     $name=htmlspecialchars($_POST['name']);
     $firstname=htmlspecialchars($_POST['firstname']);
     $email=htmlspecialchars($_POST['email']);
     $password=htmlspecialchars($_POST['password']);
     $img=htmlspecialchars($_POST['img']);

     // Insertion des informations du formulaire dans la BDD
     try {
        $req = $bdd->query("SELECT * FROM users WHERE pseudo = '$pseudo'");
        echo 'hello';
    }
    catch(Exception $e)
    {
        header('HTTP/1.1 400 crash BDD');
        die('Erreur : '.$e->getMessage());
    }


  if ($testPseudo->rowCount() > 0){
        header('HTTP/1.1 422 pseudo already taken');
        echo ('{"statut":"false","erreur" : "'.$pseudo.' déjà utilisé", "type":"1"}');
  }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo ('{"statut":"false","erreur" : "Adresse email invalid.", "type":"2"}');
    header('HTTP/1.1 422 invalid email');

  }elseif(strlen($password) < 8){
      echo ('{"statut":"false","erreur" : "Mot de passe trop court.", "type":"3"}');
      header('HTTP/1.1 422 to short password');

  }else {
    $passwordcrypt=sha1($password);
    $bdd->query("INSERT INTO users VALUES('$pseudo','$name','$firstname','$email','$passwordcrypt','$img')");
    header('HTTP/1.1 201 OK');
    $session = generateUniqueId(15) ;
    echo ('{"statut":"true","session":"'.$session.'"}');
  }
}
else {
  header('HTTP/1.1 400 no method');
}



function generateUniqueId($maxLength = null) {
    $entropy = '';

    // try ssl first
    if (function_exists('openssl_random_pseudo_bytes')) {
        $entropy = openssl_random_pseudo_bytes(64, $strong);
        // skip ssl since it wasn't using the strong algo
        if($strong !== true) {
            $entropy = '';
        }
    }

    // add some basic mt_rand/uniqid combo
    $entropy .= uniqid(mt_rand(), true);

    // try to read from the windows RNG
    if (class_exists('COM')) {
        try {
            $com = new COM('CAPICOM.Utilities.1');
            $entropy .= base64_decode($com->GetRandom(64, 0));
        } catch (Exception $ex) {
        }
    }

    // try to read from the unix RNG
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
