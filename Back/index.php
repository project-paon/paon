<?php

header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Cache-Control");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT');
header('content-type: application/json; charset=utf-8');

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
