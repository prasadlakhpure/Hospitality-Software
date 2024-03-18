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
    $currencyID = isset($_POST['currencyID']) ? $_POST['currencyID'] : $_POST['deleteCurrencyID'];

    $sql = "DELETE FROM currencymaster WHERE CurrencyID='$currencyID'";

    if (!empty($sql)) {
        if ($conn->query($sql) === TRUE) {
            echo "Delete successful";

            $deleteSql = "DELETE FROM your_other_table WHERE CurrencyID='$currencyID'";
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
