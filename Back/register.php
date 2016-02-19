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

  if ($req->rowCount() > 0){
        header('HTTP/1.1 418 pseudo already taken');
        echo ('{"statut":"false","erreur" : "'.$pseudo.' déjà utilisé"}');
  }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header('HTTP/1.1 412 invalid email');
  }elseif(strlen($password) < 6){
          header('HTTP/1.1 422 to short password');
  }else {
    $passwordcrypt=sha1($password);
    $bdd->query("INSERT INTO users VALUES('$pseudo','$name','$firstname','$email','$passwordcrypt','$img')");
    header('HTTP/1.1 201 OK');
    echo ('{"statut":"true"}');
  }
}
else {
  header('HTTP/1.1 400 no method');
}
?>
