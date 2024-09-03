<?php require 'partials/_dbconnect.php' ;

$hash = password_hash('shivam@123' , PASSWORD_DEFAULT); //password hashing algorithm
//writing query for Mysql
$sql = "INSERT INTO EMPLOYER09 VALUES ('shivam123' , '$hash' , 'shivam vishwakarma' ,'', curdate())";
//query for Mysql
$result = mysqli_query($conn , $sql);
//checking query executed successfully or not
if($result){
    echo "Data inserted successfully";
} else {
    echo "Failed to insert data: ". mysqli_error($con);
}

?>

<!-- HTML code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
welcome to our website
</body>
</html>