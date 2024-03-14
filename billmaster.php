
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

    if (isset($_POST['modify']) && $_POST['modify'] === 'modify') {
        $sql = "UPDATE billmaster SET BillCode='$billCode', BillDescription='$billDescription' WHERE BillID='$billId'";
    } elseif (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
        $checkSql = "SELECT * FROM billmaster WHERE BillID='$billId'";
        $result = $conn->query($checkSql);

        if ($result->num_rows > 0) {
            echo "Error: BillID already exists";
        } else {
            $sql = "INSERT INTO billmaster (BillID, BillCode, BillDescription) VALUES ('$billId', '$billCode', '$billDescription')";
        }
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
