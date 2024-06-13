<?php
    require("../connection.php");
?>

<table>
  <thead>
    <tr id="top-row">
      <th class="hidden">ID</th>
      <th class="title-column">Title</th>
      <th class="desc-column">Description</th>
      <th class="date-column">Date</th>
      <th class="del-column">Delete</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <?php
    session_start();
    $email = $_SESSION['email'];
    $query = "SELECT * FROM uploadFiles WHERE UserId = '$email'";
    $run = mysqli_query($connect, $query);

    if(mysqli_num_rows($run) > 0) {
      while($rows = mysqli_fetch_assoc($run)) {
        $description = implode(' ', array_slice(explode(' ', $rows["Description"]), 0, 20));
        $data = '<tr>
          <td class="hidden">' . $rows['Id'] . '</td>
          <td class="title">' . $rows['Title'] . '</td>
          <td class="desc">' . $description . '</td>
          <td class="date">' . $rows['Date'] . '</td>
          <td><button class="delete">Delete</button></td>
        </tr>';
        echo $data;
      }
    } else {
      echo "<tr><td colspan='5'><h1>No Videos Uploaded. Upload one.</h1></td></tr>";
    }
    ?>
  </tbody>
</table>