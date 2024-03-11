<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "menu";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the AJAX request
$roomCode = $_POST['roomCode'];
$roomDescription = $_POST['roomDescription'];

// Update the record in the database
$sql = "UPDATE roommaster SET RoomDescription = '$roomDescription' WHERE RoomCode = '$roomCode'";

if ($conn->query($sql) === TRUE) {
    // The update was successful
    echo "Update successful";
    header("Location: master.php");
    exit;
} else {
    // The update failed
    echo "Error updating record: " . $conn->error;
}

// Close the database connection
$conn->close();
