<head>
<meta charset="UTF-8">
</head>
<?php
$uri = $_SERVER['REQUEST_URI'];

if ( $uri === "/")
{
echo 'Home';}
else if ( $uri === "/register")
{
header('Location: register2.php');
  }
else if ( $uri === "/connexion")
{
include('connexion.php');
}
else if ( $uri === "/disconnect")
{
include('disconnect.php');
}
else if ( $uri === "/timeline")
{
include('timeline.php');
}
else if ( $uri === "/tweet")
{
include('tweet.php');
}
else if ( $uri === "/retweet")
{
include('retweet.php');
}
else
{
echo 'Ici rien à afficher, on atterira nullepart';
}
?>
