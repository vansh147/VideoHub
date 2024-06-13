<?php
  require("../connection.php");

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $data = stripslashes(file_get_contents("php://input"));
    $myData = json_decode($data, true);

    $id = $myData['id'];

    $delQuery = "DELETE FROM uploadFiles where Id = '$id'";
    $drun = mysqli_query($connect, $delQuery);

    if ($drun) {  
      echo "Success";
    } else {
      echo "Error deleting video.";
    }
  }
?>
