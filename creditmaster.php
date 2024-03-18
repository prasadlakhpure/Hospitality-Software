<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "menu";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
    $creditID = $_POST['creditID'];
    $creditCode = $_POST['creditCode'];
    $description = $_POST['description'];
    $cardLimit = $_POST['cardLimit'];
    $commission = $_POST['commission'];

    $sql = "INSERT INTO creditmaster (CreditID, CreditCode, Description, CardLimit, Commission) VALUES ('$creditID', '$creditCode', '$description', '$cardLimit', '$commission')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: master.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(isset($_POST['modify'])) {
    $modifyCreditID = $_POST['modifyCreditID'];
    $modifyCreditCode = $_POST['modifyCreditCode'];
    $modifyDescription = $_POST['modifyDescription'];
    $modifyCardLimit = $_POST['modifyCardLimit'];
    $modifyCommission = $_POST['modifyCommission'];

    $sql = "UPDATE creditmaster SET CreditCode='$modifyCreditCode', Description='$modifyDescription', CardLimit='$modifyCardLimit', Commission='$modifyCommission' WHERE CreditID='$modifyCreditID'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: master.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
