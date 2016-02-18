<?php
  include("connectionBDD.php");


  $pseudo = 'atomicfrog';
  $password = 'boudin';


   try{
       $testPseudo = $bdd->query("SELECT password FROM users WHERE pseudo = '$pseudo'");
   }catch(Exception $e)
   {
     header('HTTP/1.1 400 crash BDD');
       die('Erreur : '.$e->getMessage());
   }


  $test = $testPseudo->fetchAll();

if($test[0][0]=== $password){
  echo "connexion ok";
  //creation session

}else{
  echo "connexion pas ok";
  // header('HTTP/1.1 400 wrong password');
}
