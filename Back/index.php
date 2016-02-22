<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type');
<<<<<<< HEAD

=======
>>>>>>> cfa352ed68c087bcf69bff1166c3f8967bb77126

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type');

$uri = $_SERVER['REQUEST_URI'];

if ( $uri === "/")
{
echo 'Home';
}
else if ( $uri === "/register")
{
include('register.php');
}
else if ( $uri === "/connection")
{
include('connection.php');
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
else if ( $uri === "/like")
{
include('like.php');
}
else
{
header('HTTP/1.1 404 not found');
}
?>
