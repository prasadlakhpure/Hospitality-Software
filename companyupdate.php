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
    $companyID = isset($_POST['companyID']) ? $_POST['companyID'] : $_POST['companyID']; 
    $companyCode = $_POST['companyCode']; 
    $companyName = $_POST['companyName']; 
    $city = $_POST['city']; 

    $sql = "UPDATE companymaster SET CompanyCode='$companyCode', CompanyName='$companyName', City='$city' WHERE CompanyID='$companyID'"; 

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
