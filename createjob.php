<?php
include 'partials/_dbconnect.php';
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST" || isset($_POST['title'])){
    $title = $_POST['title'];
    $description = $_POST['desc'];
    $username = $_SESSION['username'];
    $jobid = uniqid();
    $sql = "INSERT INTO job12 (title, description,createdby,jobid) VALUES ('$title', '$description','$username' , '$jobid')";
    if(mysqli_query($conn, $sql)){
        header('Location: jobs.php');
    }
    exit();
}


?>