<?php 
    session_start();
    $email = $_SESSION['email'];
    if($email)
    {
      echo json_encode(['email' => $email]);
    }
    else{
      echo "Error fetching session data";
    }
?>
