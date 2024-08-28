<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <form action="index1.php" method="post" >


        <input type="text"
        placeholder="Name"
        name="username"
        class="input "

        >

        <input type="password" placeholder="Password" name="password">
        <input type="email" placeholder="Email" name="email" class="input">

        <button type="submit" >Submit </button>
    </form>

    <?php
      //  if($submitted){
        //    <a href="/home"></a>
        //}
    ?>

</body>

</html>

<?php
$submitted=false;
if(isset($_POST['username'])){
    $SERVER = "localhost";
    $_username = "root";
    $_Password = "";

    $con = mysqli_connect($SERVER, $_username, $_Password);

    $sql = "USE temp;";
    $con->query($sql);
    //$sql = "CREATE TABLE temptab( password varchar(255) NOT NULL , username varchar(255) NOT NULL , email varchar(255) NOT NULL );";

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $sql = "INSERT INTO temptab(username, password, email) VALUES ('$username', '$password', '$email');";
    
        
    $submitted = true;

    $con->close();
    }   
?>