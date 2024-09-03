<?php
include 'partials/_dbconnect.php';
    $title = $_GET['title'];

    mysqli_query($conn, "DELETE FROM job12 WHERE title='$title'");
    header("Location: jobs.php");
    exit();
?>