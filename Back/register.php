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
     //$img=htmlspecialchars($_FILES['img']);


     $uploaddir = '/images';
     $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);


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
      header('HTTP/1.1 422 too short password');
  }
  else {
    // Quand toutes les conditions sont remplies. On crypte le mot de passe avec sha1...
    $passwordcrypt=sha1($password);
    // et on insère les données dans la base de données.
    $session = generateUniqueId(15) ;
    if(isset($_FILES['image']) AND !empty($_FILES['image']['name'])) {
      $maxSize = 2097152;
      $validExtensions = array('jpg', 'jpeg', 'gif', 'png');
      if($_FILES['image']['size'] <= $maxSize){
        //strrchr renvoie l'extension du fichier avec le point. substr permet d'ignorer un des caractère de la chaîne, on précise qu'il s'agit du 1er avec le 1 => ça va donc ignorer le '.' et strtolower va tout mettre en minuscule, pour qu'il n'y ait pas d'erreur sur l'extension si elle est en majuscule.

        $uploadExtensions = strtolower(substr(strrchr($_FILES['image']['name'],'.'),1));
        if(in_array($uploadExtensions, $validExtensions)) {
          $path = "image/".$session.".".$uploadExtensions;
          $result = move_uploaded_file($_FILES['image']['tmp_name'],$path);
          if($result){
            $insertImage = $ bdd->prepare("INSERT INTO users SET image = :image WHERE id= :id");
            $insertImage->execute(array(
              'image' => $session.".".$uploadExtensions,
              'id' => $session
            ));
          }
          else {
            header('HTTP/1.1 422 Erreur durant l\'importation du fichier.');
          }
        }
        else {
          header('HTTP/1.1 422 Votre photo de profil doit être au format jpg, jpeg, gif, ou png.');
        }
      }
      else {
        header('HTTP/1.1 422 Votre image ne doit pas dépasser 2Mo');
      }
    }
    $bdd->query("INSERT INTO users VALUES('$pseudo','$name','$firstname','$email','$passwordcrypt','$img')");
    header('HTTP/1.1 201 OK');

    $session = generateUniqueId(15) ;
    echo ('{"statut":"true","pseudo":"'.$pseudo.'","session":"'.$session.'"}');

    /*---------------------- Gestion des cookies  -----------------------------------------*/

    setcookie("pseudo",$pseudo,time()+3600);
    setcookie("session",$session,time()+3600);

    /*---------------------- Fin de gestion des cookies -----------------------------------------*/

  }
}
else {
  header('HTTP/1.1 400 no method');
}


/*---------------------- FUNCTION de création de session -----------------------------------------*/


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
