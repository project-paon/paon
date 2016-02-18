<?php
  include("connectionBDD.php");


  $pseudo = 'atomicfrog';
  $password = 'boudin';




   try{
       $testPseudo = $bdd->query("SELECT * FROM users WHERE pseudo = '$pseudo'");
   }catch(Exception $e)
   {
       die('Erreur : '.$e->getMessage());
   }


  $test = $testPseudo->fetchAll();

  echo $test;
