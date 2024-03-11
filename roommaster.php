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
    $roomcode = $_POST['roomCode'];
    $roomdescription = $_POST['roomDescription'];
    $sql = "";

    if (isset($_POST['submit']) && $_POST['submit'] === 'submit') {
        // Insertion logic
        $sql = "INSERT INTO roommaster (RoomCode, RoomDescription)
        VALUES ('$roomcode', '$roomdescription')";
    } elseif (isset($_POST['modify']) && $_POST['modify'] === 'modify') {
        // Modification logic
        $roomId = $_POST['roomId'];
        $sql = "UPDATE roommaster SET RoomCode='$roomcode', RoomDescription='$roomdescription' WHERE RoomCode='$roomId'";
    }

    if (!empty($sql)) {
        if ($conn->query($sql) === TRUE) {
            echo "Record updated/inserted successfully";
            header("Location: master.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
