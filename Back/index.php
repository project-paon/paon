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
echo 'Ici on atteri sur la page d\'inscription';}
else if ( $uri === "/connexion")
{
echo 'Ici on atteri sur la page de connexion';
}
else if ( $uri === "/disconnect")
{
echo 'Ici on atteri sur la page de déconnexion';
}
else if ( $uri === "/timeline")
{
echo 'Ici on atteri sur la page de tweet';
}
else if ( $uri === "/post")
{
echo 'Ici on atteri sur la page pour tweetter';
}
else if ( $uri === "/delete")
{
echo 'Ici on atteri sur la page pour supprimer un tweet';
}
else if ( $uri === "/retweet")
{
echo 'Ici on atteri sur la page pour retweeter';
}
else if ( $uri === "/disconnect")
{
echo 'Ici on atteri sur la page pour liker un tweet';
}
else
{
echo 'Ici rien à afficher, on atterira nullepart';
}
?>
