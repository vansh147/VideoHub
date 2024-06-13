<?php
session_start();
require("../connection.php");

$email = $_SESSION['email'];

$userquery = "SELECT COUNT(*) AS totalUsers FROM admins";
$result1 = mysqli_query($connect, $userquery);
$vidquery = "SELECT COUNT(*) AS totalVideos FROM uploadFiles WHERE UserId = '$email'";
$result2 = mysqli_query($connect, $vidquery);

if ($result1 && mysqli_num_rows($result1) > 0) {
    $row = mysqli_fetch_assoc($result1);
    $totalUsers = $row['totalUsers'];
} else {
    $totalUsers = 0;
}

if ($result2 && mysqli_num_rows($result2) > 0) {
    $row = mysqli_fetch_assoc($result2);
    $totalVideos = $row['totalVideos'];
} else {
    $totalVideos = 0;
}
?>

<div class="mainDash">
  <div class="users">
    <div class="childUpload">
      <span class="material-symbols-outlined size">
        person
      </span>
      <span class="phpData"><?php echo $totalUsers; ?></span>
    </div>
    <span class="dataName">Users</span>
  </div>
  <div class="uploads">
    <div class="childUpload">
      <span class="material-symbols-outlined size">
        animated_images
      </span>
      <span class="phpData"><?php echo $totalVideos; ?></span>
    </div>
    <span class="dataName">Videos</span>
  </div>
</div>