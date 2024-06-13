<?php
  require("../connection.php");

  session_start();
  $email = $_SESSION['email'];
  $query = "SELECT * FROM uploadFiles where UserId = '$email'";
  $run = mysqli_query($connect, $query);
  
  if(mysqli_num_rows($run)>0)
  {
    while($rows = mysqli_fetch_assoc($run))
    {
      $description = implode(' ', array_slice(explode(' ', $rows["Description"]), 0, 75));
      echo '<div class="div1">';
      echo '<video width="640" height="360" controls class="img" poster="uploads/image/'. $rows['thumbnail'] .'">';
      echo '<source src="uploads/video/' . $rows['videoName'] . '" type="video/mp4">';
      echo 'Your browser does not support the video tag.';
      echo '</video>';
      echo '<div class="contentDiv">';
      echo '<div class="top">';
      echo '<h2>' . $rows['Title'] . '</h2>';
      echo '<sub>Uploaded at: ' . $rows['Date'] . '</sub>';
      echo '</div>';
      echo '<p>' . $description . '</p>';
      echo '</div>';
      echo '</div>';
    }
  }
  else
  {
    echo "<h1>No Videos Uploaded. Upload one.</h1>";
  }
?>