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
        $planID = $_POST['planID'];
        $planCode = $_POST['planCode'];
        $planDescription = $_POST['planDescription'];

        $sql = "INSERT INTO planmaster (PlanID, PlanCode, PlanDescription) VALUES ('$planID', '$planCode', '$planDescription')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header("Location: master.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if(isset($_POST['modify'])) {
        $modifyPlanID = $_POST['modifyPlanID'];
        $modifyPlanCode = $_POST['modifyPlanCode'];
        $modifyPlanDescription = $_POST['modifyPlanDescription'];

        $sql = "UPDATE planmaster SET PlanCode='$modifyPlanCode', PlanDescription='$modifyPlanDescription' WHERE PlanID='$modifyPlanID'";

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
