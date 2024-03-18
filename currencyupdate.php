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
    $currencyID = isset($_POST['currencyID']) ? $_POST['currencyID'] : $_POST['modifyCurrencyID'];
    $countryName = $_POST['countryName'];
    $currencyOfCountry = $_POST['currencyOfCountry'];

    $sql = "UPDATE currencymaster SET CountryName='$countryName', CurrencyOfCountry='$currencyOfCountry' WHERE CurrencyID='$currencyID'";

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
