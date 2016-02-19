<!DOCTYPE html>
<head>

</head>
<body>
  <form action="" method="post">
    <input type="text" name="pseudo" value="">
    <input type="password" name="password" value="">
    <input type="submit" name="submit" value="">
  </form>
</body>

<?php
  include("connectionBDD.php");

  $pseudo = htmlspecialchars($_POST['pseudo']);
  $password =htmlspecialchars($_POST['password']);

   try{
       $testPseudo = $bdd->query("SELECT password FROM users WHERE pseudo = '$pseudo'");
   }catch(Exception $e)
   {
     header('HTTP/1.1 400 crash BDD');
       die('Erreur : '.$e->getMessage());
   }

  $test = $testPseudo->fetchAll();

if($test[0][0]=== sha1($password)){
  echo "connexion ok";
  $session = generateUniqueId(15) ;
  $bdd->query("INSERT INTO session VALUES ('','$pseudo','$session')");
  echo '{"statut":"true","session" : "'.$session.'"}';
}else{
  header('HTTP/1.1 400 wrong password');
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
