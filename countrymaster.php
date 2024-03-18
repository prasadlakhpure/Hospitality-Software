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
        $countryID = $_POST['countryID'];
        $countryCode = $_POST['countryCode'];
        $countryName = $_POST['countryName'];

        $sql = "INSERT INTO countrymaster (CountryID, CountryCode, CountryName) VALUES ('$countryID', '$countryCode', '$countryName')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header("Location: master.php"); 
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if(isset($_POST['modify'])) {
        $modifyCountryID = $_POST['modifyCountryID'];
        $modifyCountryCode = $_POST['modifyCountryCode'];
        $modifyCountryName = $_POST['modifyCountryName'];

        $sql = "UPDATE countrymaster SET CountryCode='$modifyCountryCode', CountryName='$modifyCountryName' WHERE CountryID='$modifyCountryID'";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            header("Location: master.php"); // Redirect to appropriate page
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $conn->close();
?>
