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
        $companyID = $_POST['companyID']; 
        $companyCode = $_POST['companyCode']; 
        $companyName = $_POST['companyName']; 
        $city = $_POST['city'];

        $sql = "INSERT INTO companymaster (CompanyID, CompanyCode, CompanyName, City) VALUES ('$companyID', '$companyCode', '$companyName', '$city')"; 

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header("Location: master.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if(isset($_POST['modify'])) {
        $modifyCompanyID = $_POST['modifyCompanyID']; 
        $modifyCompanyCode = $_POST['modifyCompanyCode'];
        $modifyCompanyName = $_POST['modifyCompanyName']; 
        $modifyCity = $_POST['modifyCity']; 

        $sql = "UPDATE companymaster SET CompanyCode='$modifyCompanyCode', CompanyName='$modifyCompanyName', City='$modifyCity' WHERE CompanyID='$modifyCompanyID'"; 

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
