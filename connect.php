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

    $date = $_POST['date'];
    $time = $_POST['myTime'];
    $guestTitle = $_POST['guestTitle'];
    $guestName = $_POST['guestName'];
    $gender = $_POST['gender'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $idProof = $_POST['idproof'];
    $adharcardNumber = $_POST['adharcardNumber'];
    $pancardNumber = $_POST['pancardNumber'];
    $drivinglicenseNumber = $_POST['drivinglicenseNumber'];
    $passportNumber = $_POST['passportNumber'];
    $nationality = $_POST['nationality'];
    $email = $_POST['email'];
    $raNumber = $_POST['refer'];
    $companyName = $_POST['company'];
    $checkInDate = $_POST['checkInDate'];
    $arrivalTime = $_POST['arrivalTime'];
    $checkOutDate = $_POST['checkOutDate'];
    $departureTime = $_POST['departureTime'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $roomType = $_POST['roomtype'];
    $roomNumber = $_POST['room'];
    $plan = $_POST['plan'];
    $guestStatus = $_POST['status'];
    $billingInstruction = $_POST['billinstruction'];
    $discount = $_POST['discount'];
    $advance = $_POST['advance'];
    $roomCharge = $_POST['roomCharge'];
    $foodCharge = $_POST['foodcharge'];
    $cgstPercentage = $_POST['cgst'];
    $sgstPercentage = $_POST['sgst'];
    $extraCharge = $_POST['extracharge'];
    $totalAmount = $_POST['totalAmount'];
    $paymentMode = $_POST['paymentMode'];
    $debitCardNumber = $_POST['debitCardNumber'];
    $debitCardHolder = $_POST['debitCardHolder'];
    $debitCardExpiry = $_POST['debitCardExpiry'];
    $debitCardCVV = $_POST['debitCardCVV'];
    $creditCardType = $_POST['creditCardType'];
    $creditCardNumber = $_POST['creditCardNumber'];
    $creditCardHolder = $_POST['creditCardHolder'];
    $creditCardExpiry = $_POST['creditCardExpiry'];
    $creditCardCVV = $_POST['creditCardCVV'];
    $upiId = $_POST['Upiid'];

    if (isset($_POST['update']) && $_POST['update'] == 'update') {

        $id = $_POST['id'];
        $fetch_id_sql = "SELECT * FROM booking";
        $result = $conn->query($fetch_id_sql);
        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            $id = $row['id'];


            $sql = "UPDATE booking SET 
                date='$date', time='$time', guestTitle='$guestTitle', guestName='$guestName', gender='$gender', 
                address='$address', city='$city', pincode='$pincode', idProof='$idProof', nationality='$nationality', 
                adharcardNumber='$adharcardNumber', pancardNumber='$pancardNumber', drivinglicenseNumber='$drivinglicenseNumber',
                passportNumber='$passportNumber', email='$email', raNumber='$raNumber', companyName='$companyName', 
                checkInDate='$checkInDate', arrivalTime='$arrivalTime', checkOutDate='$checkOutDate', 
                departureTime='$departureTime', adults='$adults', children='$children', roomType='$roomType', 
                roomNumber='$roomNumber', plan='$plan', guestStatus='$guestStatus', billingInstruction='$billingInstruction', 
                discount='$discount', advance='$advance', roomCharge='$roomCharge', foodCharge='$foodCharge', 
                cgstPercentage='$cgstPercentage', sgstPercentage='$sgstPercentage', extraCharge='$extraCharge', 
                totalAmount='$totalAmount', paymentMode='$paymentMode', debitCardNumber='$debitCardNumber', 
                debitCardHolder='$debitCardHolder', debitCardExpiry='$debitCardExpiry', debitCardCVV='$debitCardCVV',
                creditCardType='$creditCardType', creditCardNumber='$creditCardNumber', creditCardHolder='$creditCardHolder', 
                creditCardExpiry='$creditCardExpiry', creditCardCVV='$creditCardCVV', Upiid='$upiId'
                WHERE id = $id";
        } else {
            echo "ID not found in the database.";
            exit;
        }
    } elseif (isset($_POST['submit']) && $_POST['submit'] == 'submit') {

        $sql = "INSERT INTO booking (date, time, guestTitle, guestName, gender, number, address, city, pincode, idProof, adharcardNumber, pancardNumber, drivinglicenseNumber, passportNumber, nationality, email, raNumber, companyName, checkInDate, arrivalTime, checkOutDate, departureTime, adults, children, roomType, roomNumber, plan, guestStatus, billingInstruction, discount, advance, roomCharge, foodCharge, cgstPercentage, sgstPercentage, extraCharge, totalAmount, paymentMode, debitCardNumber, debitCardHolder, debitCardExpiry, debitCardCVV, creditCardType, creditCardNumber, creditCardHolder, creditCardExpiry, creditCardCVV, Upiid) 
                VALUES ('$date', '$time', '$guestTitle', '$guestName', '$gender', '$number', '$address', '$city', '$pincode', '$idProof','$adharcardNumber','$pancardNumber','$drivinglicenseNumber','$passportNumber', '$nationality', '$email', '$raNumber', '$companyName', '$checkInDate', '$arrivalTime', '$checkOutDate', '$departureTime', '$adults', '$children', '$roomType', '$roomNumber', '$plan', '$guestStatus', '$billingInstruction', '$discount', '$advance', '$roomCharge', '$foodCharge', '$cgstPercentage', '$sgstPercentage', '$extraCharge', '$totalAmount', '$paymentMode','$debitCardNumber', '$debitCardHolder', '$debitCardExpiry', '$debitCardCVV','$creditCardType', '$creditCardNumber', '$creditCardHolder', '$creditCardExpiry','$creditCardCVV', '$upiId')";
    }


    if ($conn->query($sql) === TRUE) {
        echo "Record updated/inserted successfully";
        header("Location: display.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}