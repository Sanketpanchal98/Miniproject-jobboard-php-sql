<?php
include 'partials/_dbconnect.php';

echo '<h1>Getting all users</h1>';
$result = mysqli_query($con, 'SELECT * from temptab');
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['username'];
    echo "<br>";
    $i++;
}


?>