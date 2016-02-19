<?php
include('connectionBDD.php');
   if (isset($_POST['pseudo'])) {
     // Création des variables
     $pseudo=$_POST['pseudo'];
     $name=$_POST['name'];
     $firstname=$_POST['firstname'];
     $email=$_POST['email'];
     $password=$_POST['password'];
     $img=$_POST['img'] ;

     // Insertion des informations du formulaire dans la BDD
     try {
        $testPseudo = $bdd->query("SELECT * FROM users WHERE pseudo = '$pseudo'");
    }
    catch(Exception $e)
    {
        header('HTTP/1.1 400 crash BDD');
        die('Erreur : '.$e->getMessage());
    }

  if ($testPseudo->rowCount() > 0){
        header('HTTP/1.1 422 pseudo already taken');
        echo ('{"statut":"false","erreur" : "'.$pseudo.' déjà utilisé"}');
  }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header('HTTP/1.1 422 invalid email');
  }elseif(strlen($password) < 8){
      header('HTTP/1.1 422 to short password');
  }else {
    $bdd->query("INSERT INTO users VALUES($pseudo, $name,$firstname,$email,$password,$image)");
    header('HTTP/1.1 201 OK');
    echo ('{"statut":"true"}');
  }
}
else {
  header('HTTP/1.1 400 no method');
}
?>
