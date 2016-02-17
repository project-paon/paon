<?php
  include("connexionBDD.php");
  //
  // $pseudo = $_POST['pseudo'];
  // $firstname = $_POST['firstname'];
  // $name = $_POST['name'];
  // $email = $_POST['email'];
  // $password = $_POST['password'];
  // $img = $_POST['img'];
​
​
   $pseudo = 'atomicfrog';
   $firstname = 'karine';
   $name = 'jamet';
   $email = 'truc';
   $password = 'boudin';
   $img = 'pouet';

   ​    try{
        $testPseudo = $bdd->query("SELECT * FROM users WHERE pseudo = '$pseudo'");
    }catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
​
  $test = $testPseudo->fetchAll();
  print_r($test);
​
​
  if ($test->rowCount() > 0){
    die('Erreur : '.$pseudo.' déjà utilisé');
    echo "hello";
  }else {
​
    $bdd->query("INSERT INTO users VALUES($pseudo, $name,$firstname,$email,$password,$image)");
  }​
​
?>
