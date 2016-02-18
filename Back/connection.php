<?php
  include("connectionBDD.php");


  $pseudo = 'atomicfrog';
  $firstname = 'karine';
  $name = 'jamet';
  $email = 'truc';
  $password = 'boudin';
  $img = 'pouet';



   try{
       $testPseudo = $bdd->query("SELECT * FROM users WHERE pseudo = '$pseudo'");
   }catch(Exception $e)
   {
       die('Erreur : '.$e->getMessage());
   }
