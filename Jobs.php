<?php

session_start();
include 'partials/_dbconnect.php';
    $result = mysqli_query( $conn , "SELECT * FROM job12"  );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs</title>
    <link rel="stylesheet" href="Stylesheets/Jobs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    .hero{
        padding-top : 20px;
    width: 100%;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 30px;
  }

  .card{
    padding : 20px;
    border-radius : 15px;
    width: 38%;
    height: 150px;
    background-color: #fff;
    display: flex;
    gap:20px;
    flex-direction: column;
    background-color: #fff;
  }
  .card2{
    padding : 10px;
    border-radius : 15px;
    width: 100%;
    height: 80px;
    background-color: #fff;
    display: flex;
    gap:20px;
    flex-direction: column;
    background-color: #fff;
  }
  .apply{
    font-size: 18px;
    background-color: #3498DB;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    text-decoration : none;
    text-align:center;
  }
  .but{
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration : none;
  }
    </style>
</head>
<body>
    <nav class="nav">
        <i class="fa-solid fa-bars fa-xl bar" style="color: #000000;"></i>
        <img src="Logo.png" alt="Logo" class="logo">
        <div class="search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search">
            <i class="fa-solid fa-microphone"></i>
        </div>
        <div class="items">
            <a href="Home.html" class="item hover-effect">Home</a>
            <a href="Jobs.html" class="item hover-effect">Jobs</a>
            <a href="Contact.html" class="item hover-effect">Contact us</a>
            <a href="Aboutus.html" class="item2 hover-effect">About us</a>
        </div>
        <?php 
            if(isset($_SESSION['username'])) echo "<a href='profile.php' class='but'>Profile</a>";
            else {echo "<a href='login.php' class='but'>Login</a><a href='signin.php' class='but'>signin</a>";}
        ?>
    </nav>
<div class="hero">
    <?php
    while($row = $result->fetch_assoc()){
        $title = $row["title"];
        $desc = $row['Description'];
        $createdby = $row['createdby'];
        $jobid = $row['jobid'];
            echo "<div class='card'>";
            echo "<div class='card2'><h4>$title</h4>";
            echo "<p>$desc</p>";
            echo "<p>Created by : $createdby</p></div>";
            if(isset($_SESSION['username'])){
                if($_SESSION['role'] === 'employer09'&&$_SESSION['username']===$createdby){
                echo "<a href='deletejob.php?title=$title' class='apply' style='background-color:Red;'>Delete</a>";
            } 
            else if($_SESSION['role'] === 'candidate17')echo "<a href='apply.php?title=$jobid' class='apply'>Apply</a>";
            echo "</div>";
            }
            
        }
        ?>
</div>
</body>
</html>
