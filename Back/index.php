<?php

// On autorise les accès au contenu de l'API.
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT');
header('content-type: application/json; charset=utf-8');

$uri = $_SERVER['REQUEST_URI'];

switch ($uri){
  case '/':
    echo 'HOME';
  break;
  case '/register':
    include('register.php');
  break;
  case '/connection':
    include('connection.php');
  break;
  case '/disconnect':
    include('disconnect.php');
  break;
  case '/timeline':
    include('timeline.php');
  break;
  case '/tweet':
    include('tweet.php');
  break;
  case '/retweet':
    include('retweet.php');
  break;
  case '/like':
    include('like.php');
  break;
  default:
  header('HTTP/1.1 404 not found');
}
?>
