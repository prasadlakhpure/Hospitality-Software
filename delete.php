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
    $id = $_POST['id'];

    $sql = "DELETE FROM booking WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Row deleted successfully";
        header("Location: display.php");
        exit;

    } else {
        echo "Error deleting row: " . $conn->error;
    }
}

$conn->close();
?>
