<?php
  require("../connection.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["Id"];
    $updatedTitle = $_POST["Title"];
    $updatedDescription = $_POST["Description"];
    $updatedDate = date("Y-m-d");
    if($updatedTitle == "" || $updatedDescription == "")
    {
      echo "Empty fields.";
    }
    else  
    {
      $updateQuery = "UPDATE uploadFiles SET Title='$updatedTitle', Description='$updatedDescription', Date='$updatedDate' WHERE id='$id'";
      $urun = mysqli_query($connect, $updateQuery);
      if ($urun) 
      {        
        echo "Success";
      } 
      else 
      {
        echo "Error updating video.";
      }
    }
  }
?>