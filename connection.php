<?php

  $server = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $dbname = "vansh";

  $connect = mysqli_connect($server, $dbuser, $dbpass, $dbname);

  if(!$connect)
  {
    die("Something went wrong while connecting to databse.");
  }

?>