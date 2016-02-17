<?php
try{
  $bdd = new PDO('mysql:host=localhost;dbname=paonBDD;charset=utf8', 'root', 'Hiboux.');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

?>
