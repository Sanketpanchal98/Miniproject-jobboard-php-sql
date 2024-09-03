<?php
include 'partials/_dbconnect.php';
if (isset($_GET['name'])) {
    $directory = "uploads/";
    $imageName = $_GET['name'];
    $filePath = $directory . $imageName;

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            mysqli_query($conn, "DELETE FROM candidate17 WHERE resume='$imageName'");
            echo "The file $imageName has been deleted.";
        } else {
            echo "Error: Unable to delete $imageName.";
        }
    } else {
        echo "File does not exist.";
    }
} else {
    echo "No file specified.";
}

header("Location: profile.php"); 
exit;
?>
