<?php

  require("../connection.php");

  $sendData = stripcslashes(file_get_contents("php://input"));
  $sendMyData = json_decode($sendData, true);

  $name = $sendMyData['name'];
  $email = $sendMyData['email'];
  $password = $sendMyData['password'];

  $hash = "$1$10$";
  $password = crypt($password, $hash);

  $sendDataQuery = "INSERT INTO admins(name , email, password) VALUES('$name', '$email', '$password')";
  $sendDataQueryRun = mysqli_query($connect, $sendDataQuery);

  if($sendDataQueryRun)
  {
    echo "Success";
  }
  else
  {
    echo "Error sending data.";
  }

?>