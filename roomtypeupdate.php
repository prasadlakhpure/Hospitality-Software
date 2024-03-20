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
    $roomDescription = $_POST['roomDescription'];

    $stmt = $conn->prepare("UPDATE roomtypemaster SET RoomDescription=? WHERE RoomCode=?");
    $stmt->bind_param("ss", $roomDescription, $roomCode);

    if ($stmt->execute() === TRUE) {
        echo "Update successful";
        header("Location: master.php"); 
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
