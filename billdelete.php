
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

    $sql = "DELETE FROM billmaster WHERE BillID='$billId'";

    if (!empty($sql)) {
        if ($conn->query($sql) === TRUE) {
            echo "Delete successful";

            $deleteSql = "DELETE FROM your_other_table WHERE BillID='$billId'";
            if ($conn->query($deleteSql) === TRUE) {
                echo "Record deleted from the database";
            } else {
                echo "Error deleting record from the database: " . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
