<?php 
$loginsuccess = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
require 'partials/_dbconnect.php' ;
$username = $_POST['username'];
$password = $_POST['password'];
$fullname = $_POST['fullname'];
$role = $_POST['role'];
$sql = "select * from $role where username='$username'";
$result = mysqli_query($conn , $sql);
$num = mysqli_num_rows($result);
if($num == 1){
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>  Username Already Taken!!  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
} else {
    $hash = password_hash('$password' , PASSWORD_DEFAULT); //password hashing algorithm
    //writing query for Mysql
    $sql = "INSERT INTO $role VALUES ('$username' , '$hash' , '$fullname' ,'', curdate())";
    //query for Mysql
    $result = mysqli_query($conn , $sql);
    //checking query executed successfully or not
    if($result){
        $loginsuccess = true;
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="Stylesheets/signin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <?php if($loginsuccess){ echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>  Data inserted Successfully!!  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; }?>
    <div class="form">
        <img src="images/bgimage.jpg" alt="bgimage" class="bgimage">
        <div class="login">
            <h4>Sign Up</h4>
            <form method="post" action="signin.php">
                <div class="input">
                    <label for="username">Username or Email</label>
                    <input type="text" id="username" name="username" placeholder="Username or Email" required>
                </div>
                <div class="input">
                    <label for="create-password">Create Password</label>
                    <input type="password" id="create-password" name="password" placeholder="Create Password" required>
                </div>
                
                <div class="input">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="username" name="fullname" placeholder="Fullname" required>
                </div>
                <div class="input checkbox">
                    <label for="role">Organization</label>
                    <input type="radio"name="role" class="role" value="employer09">
                    <label for="role">Candidate</label>
                    <input type="radio" name="role" value="candidate17" class="role">
                </div>
                <button type="submit">Sign Up</button>
                <div class="links">
                    <a href="login.php">Already have an account?</a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector("form");
            const passwordInput = document.getElementById("create-password");
            const confirmPasswordInput = document.getElementById("confirm-password");

            form.addEventListener("submit", function (event) {
                if (passwordInput.value == confirmPasswordInput.value) {
                    event.preventDefault(); 
                    window.location.href = "home.html";
                    
                } else {
                    
                    alert("Passwords do not match. Please try again.");
                    confirmPasswordInput.focus();
                }
            });

            confirmPasswordInput.addEventListener("input", function () {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.setCustomValidity("Passwords do not match.");
                } else {
                    confirmPasswordInput.setCustomValidity("");
                }
            });
        });

    </script>
    
    
    
</body>
</html>
