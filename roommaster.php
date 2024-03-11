
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
    $roomId = isset($_POST['roomId']) ? $_POST['roomId'] : "";
    $roomcode = $_POST['roomCode'];
    $roomdescription = $_POST['roomDescription'];

    if (isset($_POST['modify']) && $_POST['modify'] === 'modify') {
        $roomId = $_POST['roomId'];
        $fetch_id_sql = "SELECT * FROM roommaster";
        $result = $conn->query($fetch_id_sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $roomId = $row['roomId'];
            $sql = "UPDATE roommaster SET RoomCode='$roomcode', RoomDescription='$roomdescription' WHERE RoomID='$roomId'";
        } else {
            echo "ID not found in the database.";
            exit;
        }
    } elseif (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
        $sql = "INSERT INTO roommaster (RoomCode, RoomDescription) VALUES ('$roomcode', '$roomdescription')";
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
