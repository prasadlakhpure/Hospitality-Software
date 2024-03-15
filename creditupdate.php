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
    $creditCode = $_POST['creditCode'];
    $description = $_POST['description'];
    $cardLimit = $_POST['cardLimit'];
    $commission = $_POST['commission'];

    $sql = "UPDATE creditmaster SET CreditCode='$creditCode', Description='$description', CardLimit='$cardLimit', Commission='$commission' WHERE CreditID='$creditId'";

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
