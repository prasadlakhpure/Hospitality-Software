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
        $billID = $_POST['billID'];
        $billCode = $_POST['billCode'];
        $billDescription = $_POST['billDescription'];

        $sql = "INSERT INTO billmaster (BillID, BillCode, BillDescription) VALUES ('$billID', '$billCode', '$billDescription')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header("Location: master.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if(isset($_POST['modify'])) {
        $modifyBillID = $_POST['modifyBillID'];
        $modifyBillCode = $_POST['modifyBillCode'];
        $modifyBillDescription = $_POST['modifyBillDescription'];

        $sql = "UPDATE billmaster SET BillCode='$modifyBillCode', BillDescription='$modifyBillDescription' WHERE BillID='$modifyBillID'";

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
