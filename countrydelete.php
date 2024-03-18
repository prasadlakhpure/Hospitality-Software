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
    $countryId = isset($_POST['countryId']) ? $_POST['countryId'] : $_POST['countryID'];

    $sql = "DELETE FROM countrymaster WHERE CountryID='$countryId'";

    if (!empty($sql)) {
        if ($conn->query($sql) === TRUE) {
            echo "Delete successful";
           
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
