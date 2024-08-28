<?php   
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
    
    <nav class="w-full h-[90px] bg-gray-400 flex justify-center items-center gap-9">

        <a href="./index.php">Home</a>
        <?php
        //if($_SESSION['islog'] == false){
            echo "<a href='./login.php' class=''> Login </a>";
            echo "<a href='./signin.php'> Signin </a>";
        //}   else {
            echo "<a href='logout.php'>Logout</a>";
        //}

        ?>
        
    </nav>

</body>
</html>