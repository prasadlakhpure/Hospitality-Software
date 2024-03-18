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
    $countryCode = $_POST['countryCode'];
    $countryName = $_POST['countryName'];

    $sql = "UPDATE countrymaster SET CountryCode='$countryCode', CountryName='$countryName' WHERE CountryID='$countryId'";

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
