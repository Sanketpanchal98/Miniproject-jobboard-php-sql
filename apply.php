<?php
session_start();
include 'partials/_dbconnect.php';

    $title = $_GET['title'];
    $username = $_SESSION['username'];
    mysqli_query($conn,"update job12 SET appliedby = '$username' where jobid = '$title' " );
    header("Location: jobs.php");
    exit();
?>