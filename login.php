<?php
include 'partials/_dbconnect.php';
$isloggedin = false;
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['role'])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $result = mysqli_query( $conn , "SELECT * FROM $role where username= '$username'"  );
    $num= mysqli_num_rows( $result );
    if($num === 1){
        while($row = $result->fetch_assoc()){
            if(password_verify( '$password' , $row["password"])){
              $isloggedin = true;
              session_start();
              $_SESSION['username'] = $username;
              $_SESSION['name'] = $row["name"];
              $_SESSION['role'] = $role;
              header("Location: profile.php");
            }
        }
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Invalid Credentials!!  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="Stylesheets/signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="form">
        <img src="images/bgimage.jpg" alt="bgimage" class="bgimage">
        <div class="login">
            <h4>Login</h4>
            <form method="post" action="login.php">
                <div class="input">
                    <label for="username">Username or Email</label>
                    <input type="text" id="username" placeholder="Username or Email" name="username" required>
                </div>
                <div class="input">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Password" name="password" required>
                </div>
                <div class="input checkbox">
                    <label for="role">Organization</label>
                    <input type="radio"name="role" class="role" value="employer09">
                    <label for="role">Candidate</label>
                    <input type="radio" name="role" value="candidate17" class="role">
                </div>
                <button type="submit">Log In</button>
                <div class="links">
                    <a href="signin.php">Sign Up</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
