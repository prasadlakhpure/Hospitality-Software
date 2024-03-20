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
    $planId = isset($_POST['planId']) ? $_POST['planId'] : $_POST['planID'];

    if (!empty($planId)) {
        $sql = "DELETE FROM planmaster WHERE PlanID='$planId'";

        if (!empty($sql)) {
            if ($conn->query($sql) === TRUE) {
                $deleteSql = "DELETE FROM your_other_table WHERE PlanID='$planId'";
                if ($conn->query($deleteSql) === TRUE) {
                    echo "Delete successful";
                } else {
                    echo "Error deleting record from the related table: " . $conn->error;
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>
