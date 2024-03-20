<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "menu";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
    $roomCode = $_POST['roomCode'];
    $roomDescription = $_POST['roomDescription'];

    $stmt = $conn->prepare("INSERT INTO roomtypemaster (RoomCode, RoomDescription) VALUES (?, ?)");
    $stmt->bind_param("ss", $roomCode, $roomDescription);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
        header("Location: master.php"); 
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

if(isset($_POST['modify'])) {
    $modifyRoomCode = $_POST['modifyRoomCode'];
    $modifyRoomDescription = $_POST['modifyRoomDescription'];

    $stmt = $conn->prepare("UPDATE roomtypemaster SET RoomDescription=? WHERE RoomCode=?");
    $stmt->bind_param("ss", $modifyRoomDescription, $modifyRoomCode);

    if ($stmt->execute() === TRUE) {
        echo "Record updated successfully";
        header("Location: master.php"); 
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
