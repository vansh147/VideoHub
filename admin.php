<?php 
    session_start();
    $email = $_SESSION['email'];
    if(!$email)
    {
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vlogs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="adminPages/dash.css">
    <link rel="stylesheet" href="adminPages/create.css">
    <link rel="stylesheet" href="adminPages/read.css">
    <link rel="stylesheet" href="adminPages/update.css">
    <link rel="stylesheet" href="adminPages/delete.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
  <div class="container">
    <header class="header">
      <div class="head_container">
        <span id="dash">
          &nbsp;
          <span class="material-icons size">manage_accounts</span>
          <h1>&nbsp;Dashboard</h1>
        </span>
        <div class="right_head">
          <button><i class="fa-solid fa-moon" onclick="toggleSwap()"></i></button>
          <div class="expand">
            <button id="parentBtn" onclick="logout()"><i class="btn1"></i></button>
          </div>
        </div>
      </div>
    </header>
    <div class="main">
      <div class="left">
        <nav class="nav">
          <a href="adminPages/create.html"><div class="nav-item" button>Create</div></a>
          <a href="adminPages/read.php"><div class="nav-item">Read</div></a>
          <a href="adminPages/update.php"><div class="nav-item">Update</div></a>
          <a href="adminPages/delete.php"><div class="nav-item">Delete</div></a>
        </nav>
        <footer class="footer">&copy; 2024 VlogTube</footer>
      </div>
      <main class="content">
        
      </main> 
    </div>
  </div>
  <script src="index.js"></script>
  <script src="admin.js"></script>
</body>
</html>