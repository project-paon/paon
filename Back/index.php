<?php

$uri = $_SERVER['REQUEST_URI'];

if ( $uri === "/")
{
echo 'Home';}
else if ( $uri === "/register")
{
  include('register.php');
}
else if ( $uri === "/connexion")
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
else
{
 header('HTTP/1.1 404 not found');

}
?>
