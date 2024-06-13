<?php

require("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Title = $_POST["Title"];
    $Description = $_POST["Description"];
    $thumbnail = $_FILES["image"]["name"];
    $tdir = "../uploads/image/";
    $thumbnailPath = $tdir. $thumbnail;
    $videoName = basename($_FILES["video"]["name"]);
    $vdir = "../uploads/video/";
    $videoPath = $vdir. $videoName;
    $dateInput = date("Y-m-d");
    session_start();
    $email = $_SESSION["email"];

    if($Title == "" || $Description == "" || $thumbnail == "" || $videoName == "")
    {
        echo "Empty fields.";
    }
    else
    {
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $thumbnailPath) && move_uploaded_file($_FILES["video"]["tmp_name"], $videoPath))
        {
            $insertQuery = "INSERT INTO uploadFiles(UserId, Title, Description, Date, thumbnail, videoName) VALUES ('$email', '$Title', '$Description', '$dateInput', '$thumbnail', '$videoName')";
            $irun = mysqli_query($connect, $insertQuery);
        
            if ($irun) {
                
                echo "Success";
            } 
            else 
            {
                echo "Error uploading video.";
            }
        }
        else
        {
            echo "Files did not uploaded.";
        }
    }
}
?>
