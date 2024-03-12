<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "menu";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$roomCode = $_POST['roomCode'];
$roomDescription = $_POST['roomDescription'];


$sql = "UPDATE roommaster SET RoomDescription = '$roomDescription' WHERE RoomCode = '$roomCode'";

if ($conn->query($sql) === TRUE) {
    
    echo "Update successful";
    header("Location: master.php");
    exit;
} else {
 
    echo "Error updating record: " . $conn->error;
}


$conn->close();
