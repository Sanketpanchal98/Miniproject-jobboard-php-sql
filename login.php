<?php
include 'partials/_dbconnect.php';
if($_SERVER['REQUEST_METHOD'] == "POST" || isset($_POST['username'])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hash = password_hash($password , PASSWORD_DEFAULT);
    
    $result = mysqli_query( $con , "SELECT * FROM temptab where username= '$username' "  );
    $num= mysqli_num_rows( $result );
    if($num === 1){
        while($row = mysqli_fetch_assoc( $result )){
            if(password_verify(  $password , $row["password"] )){
            session_start();
            $_SESSION['islog'] = true;
            $_SESSION['username'] = $username;
            header('location: profile.php');
            }
        }
    } else {
        echo "password is wrong";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="Stylesheets/signup.css">
</head>
<body>
    <div class="form">
        <img src="images/bgimage.jpg" alt="images/bgimage.jpg" class="bgimage">
        <div class="login">
            <h1>Sign Up</h1>
            <form>
                <div class="input">
                    <label for="username">Username or Email</label>
                    <input type="text" id="username" name="username" placeholder="Username or Email" required>
                </div>
                <div class="input">
                    <label for="create-password">Create Password</label>
                    <input type="password" id="create-password" name="create-password" placeholder="Create Password" required>
                </div>
                <div class="input">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
                </div>
                <button type="submit">Sign Up</button>
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
