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
    $creditId = isset($_POST['creditId']) ? $_POST['creditId'] : $_POST['creditID'];

    $sql = "DELETE FROM creditmaster WHERE CreditID='$creditId'";

    if (!empty($sql)) {
        if ($conn->query($sql) === TRUE) {
            echo "Delete successful";

            $deleteSql = "DELETE FROM your_other_table WHERE CreditID='$creditId'";
            if ($conn->query($deleteSql) === TRUE) {
                echo "Associated records deleted from the database";
            } else {
                echo "Error deleting associated records from the database: " . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
