<?php
include 'partials/_dbconnect.php';
session_start();
if (isset($_POST['submit'])) {
    $target_dir = "uploads/"; // Directory where images will be stored
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $username = $_SESSION['username'];
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "UPDATE candidate17 SET resume = '$target_file' WHERE username = '$username'; ";
            if ($conn->query($sql) === TRUE) {
                echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
                header("Location: profile.php");    
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$directory = "uploads/"; 
$images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="Stylesheets/profile.css">
    <style>
    input[type=file]::file-selector-button {
  margin-right: 20px;
  border: none;
  background: #084cdf;
  padding: 10px 20px;
  border-radius: 10px;
  color: #fff;
  cursor: pointer;
  transition: background .2s ease-in-out;
  margin-top: 10px;
}

input[type=file]::file-selector-button:hover {
  background: #0d45a5;
}

.butsub{
    background-color: #084cdf;
    color : #fff;
    padding: 5px 9px;
    border : none;
    border-radius: 10px;
}
.jobform {
            width: 50%;
            display: flex;
            flex-direction: column;
            gap: 10px;
            justify-content: center;
        }
        label {
            display: block;
        }
        .jobform input{
            padding:10px;
            height: 30px;
            border-radius: 15px;
            border-color: blue;
        }
        .jobform textarea {
            height: 100px;
            padding: 5px;
            border-radius: 15px;
            border-color: blue;
        }
        .createjob{
            width: 80px;
            background-color: #084cdf;
            color : #fff;
            padding: 5px 9px;
            border : none;
            border-radius: 10px;
            cursor: pointer;
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
            <a href="index.php" class="item hover-effect">Home</a>
            <a href="Jobs.php" class="item hover-effect">Jobs</a>
            <a href="Contact.php" class="item hover-effect">Contact us</a>
            <a href="Aboutus.php" class="item2 hover-effect">About us</a>
        </div>
        <a href="logout.php" class="but">Logout</a>
    </nav>
    <hero>
        <img src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?size=338&ext=jpg&ga=GA1.1.1413502914.1725235200&semt=ais_hybrid" alt="" class="profilepic">
        <h4>Username : <?php echo $_SESSION['username'] ; ?></h4>
        <h4>Fullname : <?php echo $_SESSION['name'] ; ?></h4>
    <?php
    $username = $_SESSION['username'];
        if($_SESSION['role'] === 'candidate17'){
            echo "<form action='profile.php' method='post' enctype='multipart/form-data'><p>Upload your resume</p><input type='file' name='image' accept='image/*' required class='inputbut'><input type='submit' name='submit' value='Upload' class='but'></form>";
            foreach ($images as $image) {
                $imageName = basename($image);
                echo "<img src='$image' width='200' alt='Image'><br><a href='delete.php?name=$imageName' class='butsub' style='text-decoration:none;'>Delete</a><br><br>";
            }
        }
        else if($_SESSION['role'] === 'employer09'){
            //echo "<form action='profile.php' method='post' enctype='multipart/form-data' class='inputbut'><input type='file' name='image' accept='image/*' required><input type='submit' name='submit' value='Upload' class='butsub'></form>";
            echo "<form class='jobform' method='post' action='createjob.php'><label for='title'>Title</label>    <input type='text' name='title' id='title' placeholder='Title'> Description<textarea name='desc' id='Description'></textarea><button type='submit' class='createjob'>Create job</button></form>";
            echo "<div class=''><h4>Applied by : </h4></div>";
            $jobs = mysqli_query($conn, "SELECT * FROM job12 WHERE createdby = '$username'");       
            while($row = mysqli_fetch_assoc($jobs)){
                $appliedby =  $row['appliedby'];
                echo "<br>";
                $resume = mysqli_query($conn, "SELECT * FROM candidate17 WHERE username = '$appliedby'"); 
                while($row2 = mysqli_fetch_assoc($resume)){
                    $res = $row2["Resume"];
                    echo "<img src='$res'>";
                    echo $row2["name"];
                }
            }
        }
        
        ?>
    </hero>
</body>

</html>