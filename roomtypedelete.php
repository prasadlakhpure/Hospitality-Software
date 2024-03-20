<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "menu";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomCode = $_POST['roomCode'];

    $stmt = $conn->prepare("DELETE FROM roomtypemaster WHERE RoomCode=?");
    $stmt->bind_param("s", $roomCode);

    if ($stmt->execute() === TRUE) {
        echo "Delete successful";
        
        $deleteStmt = $conn->prepare("DELETE FROM your_other_table WHERE RoomCode=?");
        $deleteStmt->bind_param("s", $roomCode);
        
        if ($deleteStmt->execute() === TRUE) {
            echo "Associated records deleted from the database";
        } else {
            echo "Error deleting associated records: " . $deleteStmt->error;
        }
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
