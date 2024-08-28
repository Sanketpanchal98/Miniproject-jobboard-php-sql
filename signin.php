<?php
if(isset($_POST['username'])||$_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'partials/_dbconnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $hash = password_hash($password , PASSWORD_DEFAULT);
    $res = mysqli_query($con , "select * from temptab where username = '$username'");
    $num = mysqli_num_rows($res);
    if($num === 1){
        echo "username is already taken";
    } else {
        $sql = "INSERT INTO temptab VALUES ('$hash', '$username', '$name')";
        mysqli_query($con, $sql );
        session_start();
        $_SESSION['islog'] = true;
        $_SESSION['username'] = $username;
        header('location: profile.php');
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <form action="signin.php" method="post">
        <input type="text" placeholder="username" name="username">
        <input type="password" placeholder="password" name="password">
        <input type="text" placeholder="full name" name="name">
        <button type="submit">signin</button>

    </form>


</body>
</html>