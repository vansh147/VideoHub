<?php require("connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vlogs</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <div class="container">
    <header class="header">
      <div class="head_container">
        <h1>VideoHub</h1>
        <span>
          <input type="text" placeholder="Search...">
          <i class="fa-solid fa-magnifying-glass"></i>
        </span>
        <div class="right_head">
          <!-- <i class="fa-solid fa-sun" onclick="toggleSwap()"></i> -->
          <button><i class="fa-solid fa-moon" onclick="toggleSwap()"></i></button>
          <button onclick="window.location.href='login_signup/'"><i class="fa-solid fa-user"></i></button>
        </div>
      </div>
    </header>
    <div class="main">
      <!-- <div class="left">
        <nav class="nav"></nav>
        <footer class="footer">&copy; 2024 VlogTube</footer>
      </div> -->
      <main class="content">
        
          <?php
            $query = "SELECT * FROM uploadFiles";
            $run = mysqli_query($connect, $query);
            
            if(mysqli_num_rows($run)>0)
            {
              while($rows = mysqli_fetch_assoc($run))
              {
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
                echo '<p>' . $rows['Description'] . '</p>';
                echo '</div>';
                echo '</div>';
              }
            }
            else
            {
              echo "<h1>No Videos Uploaded. Login to admin pannel to upload one.</h1>";
            }
          ?>
          <!-- <div class="contentDiv">
            <div class="top">
              <h2>Title</h2>
              <sub>Date: x/y/z</sub>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt architecto possimus enim? Perferendis minus est ipsum quidem nam sunt laboriosam veniam necessitatibus ratione delectus libero tenetur sequi cupiditate nemo, ipsa ipsam dignissimos sit accusantium dolorem illum dolores. Libero at unde adipisci dolor et odio velit nesciunt, voluptates, veniam, quia necessitatibus vitae sunt!</p>
          </div> -->
      </main>
    </div>
  </div>
  <script src="index.js"></script>
</body>
</html>