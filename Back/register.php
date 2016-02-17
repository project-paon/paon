<!DOCTYPE html>
<head>

</head>
<body>
  <form action="" method="post">
    <input type="text" name="pseudo" value="">
    <input type="text" name="name" value="">
    <input type="text" name="firstname" value="">
    <input type="email" name="email" value="">
    <input type="password" name="password" value="">
    <input type="text" name="img" value="">
    <input type="submit" name="submit" value="">
  </form>
</body>

<?php
include('connectionBDD.php');
   if (isset($_POST['submit'])) {
     // Création des variables
     $pseudo=$_POST['pseudo'];
     $name=$_POST['name'];
     $firstname=$_POST['firstname'];
     $email=$_POST['email'];
     $password=$_POST['password'];
     $img=$_POST['img'] ;

     // Insertion des informations du formulaire dans la BDD

     $send = $bdd->prepare("INSERT INTO users(pseudo,name,firstname,email,password,image) VALUES (?,?,?,?,?,?)");
     $send->execute(array($pseudo, $name, $firstname, $email, $password, $img));
     echo $pseudo ;
     echo 'Votre inscription est bien enregistrée';
     echo json_encode(array("blablabla"=>$variable));

   }
?>
