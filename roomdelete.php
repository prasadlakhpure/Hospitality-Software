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
    $roomId = $_POST['roomId']; 

    $sql = "DELETE FROM roommaster WHERE RoomCode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $roomId);

    if ($stmt->execute()) {
        echo "Row deleted successfully";
        header("Location: master.php");
        exit;
    } else {
        echo "Error deleting row: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>