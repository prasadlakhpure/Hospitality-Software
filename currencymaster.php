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
        $currencyID = $_POST['currencyID'];
        $countryName = $_POST['countryName'];
        $currencyOfCountry = $_POST['currencyOfCountry'];

        $sql = "INSERT INTO currencymaster (CurrencyID, CountryName, CurrencyOfCountry) VALUES ('$currencyID', '$countryName', '$currencyOfCountry')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header("Location: master.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if(isset($_POST['modify'])) {
        $modifyCurrencyID = $_POST['modifyCurrencyID'];
        $modifyCountryName = $_POST['modifyCountryName'];
        $modifyCurrencyOfCountry = $_POST['modifyCurrencyOfCountry'];

        $sql = "UPDATE currencymaster SET CountryName='$modifyCountryName', CurrencyOfCountry='$modifyCurrencyOfCountry' WHERE CurrencyID='$modifyCurrencyID'";

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
