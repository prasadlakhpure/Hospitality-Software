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
        $roomID = $_POST['roomID'];
        $roomCode = $_POST['roomCode'];
        $roomDescription = $_POST['roomDescription'];

        $sql = "INSERT INTO roommaster (RoomID, RoomCode, RoomDescription) VALUES ('$roomID', '$roomCode', '$roomDescription')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header("Location: roommaster.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if(isset($_POST['modify'])) {
        $modifyRoomID = $_POST['modifyRoomID'];
        $modifyRoomCode = $_POST['modifyRoomCode'];
        $modifyRoomDescription = $_POST['modifyRoomDescription'];

        $sql = "UPDATE roommaster SET RoomCode='$modifyRoomCode', RoomDescription='$modifyRoomDescription' WHERE RoomID='$modifyRoomID'";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            header("Location: roommaster.php");
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $conn->close();
?>
