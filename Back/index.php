<?php

$uri = $_SERVER['REQUEST_URI'];

if ( $uri === "/")
{
echo 'Home';
}
else if ( $uri === "/register")
{
<<<<<<< HEAD
include('register.php');  }
=======
  include('register.php');
}
>>>>>>> a090bdf2df3219d3af68ce1ec73e1c368bea2b9a
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
<<<<<<< HEAD
header('HTTP/1.1 400 Bad Request');
=======
 header('HTTP/1.1 404 not found');

>>>>>>> a090bdf2df3219d3af68ce1ec73e1c368bea2b9a
}
?>
