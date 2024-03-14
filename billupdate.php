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
    $billId = isset($_POST['billId']) ? $_POST['billId'] : $_POST['billID'];
    $billCode = $_POST['billCode'];
    $billDescription = $_POST['billDescription'];

    $sql = "UPDATE billmaster SET BillCode='$billCode', BillDescription='$billDescription' WHERE BillID='$billId'";

    if (!empty($sql)) {
        if ($conn->query($sql) === TRUE) {
            echo "Update successful";
            header("Location: master.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
