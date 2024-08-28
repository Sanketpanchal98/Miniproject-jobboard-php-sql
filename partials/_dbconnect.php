<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "workwavedb";

$conn = mysqli_connect($server, $username, $password , $database);

if(!$conn){
    echo "connection failed";
    exit();
}

?>