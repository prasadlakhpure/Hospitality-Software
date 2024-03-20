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
    $planId = isset($_POST['planId']) ? $_POST['planId'] : $_POST['modifyPlanID'];
    $planCode = $_POST['planCode'];
    $planDescription = $_POST['planDescription'];

    $sql = "UPDATE planmaster SET PlanCode='$planCode', PlanDescription='$planDescription' WHERE PlanID='$planId'";

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
