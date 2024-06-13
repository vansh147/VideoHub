<?php

  require("../connection.php");

  $data = stripcslashes(file_get_contents("php://input"));
  $myData = json_decode($data, true);

  $mail = $myData['email'];
  $pass = $myData['password'];

  $hash = "$1$10$";
  $pass = crypt($pass, $hash);

  $getDataQuery = "SELECT id from admins where email='$mail' && password='$pass'";
  $getDataQueryRun = mysqli_query($connect, $getDataQuery);

  if($getDataQueryRun)
  {
    if(mysqli_num_rows($getDataQueryRun)>0)
    {
      session_start();
      $_SESSION["email"]=$mail;
      echo "Success";
    }
    else
    {
      echo "Invalid Email or Password";
    }
  }
  else
  {
    echo "Error while running query";
  }

?>