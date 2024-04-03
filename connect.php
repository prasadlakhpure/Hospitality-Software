<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "menu";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("INSERT INTO booking (date, time, guestTitle, guestName, gender, number, address, city, pincode, idproof, adharcardNumber, pancardNumber, drivinglicenseNumber, passportNumber, nationality, email, raNumber, companyName, checkInDate, arrivalTime, checkOutDate, departureTime, adults, children, roomType, roomNumber, plan, guestStatus, billingInstruction, discount, advance, roomCharge, foodCharge, cgst, sgst, discountAmount, cgstAmount, sgstAmount, extraCharge, totalAmount, paymentMode, debitCardNumber, debitCardHolder, debitCardExpiry, debitCardCVV, creditCardType, creditCardNumber, creditCardHolder, creditCardExpiry, creditCardCVV, Upiid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss", $date, $time, $guestTitle, $guestName, $gender, $number, $address, $city, $pincode, $idproof, $adharcardNumber, $pancardNumber, $drivinglicenseNumber, $passportNumber, $nationality, $email, $raNumber, $companyName, $checkInDate, $arrivalTime, $checkOutDate, $departureTime, $adults, $children, $roomType, $roomNumber, $plan, $guestStatus, $billingInstruction, $discount, $advance, $roomCharge, $foodCharge, $cgst, $sgst, $discountAmount, $cgstAmount, $sgstAmount, $extraCharge, $totalAmount, $paymentMode, $debitCardNumber, $debitCardHolder, $debitCardExpiry, $debitCardCVV, $creditCardType, $creditCardNumber, $creditCardHolder, $creditCardExpiry, $creditCardCVV, $Upiid);


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
    $cgstPecentage = $_POST['cgst'];
    $sgstPercentage = $_POST['sgst'];
    $discountAmount = $_POST['discountAmount'];
    $cgstAmount = $_POST['cgstAmountInput'];
    $sgstAmount = $_POST['sgstAmountInput'];
    $extraCharge = $_POST['extracharge'];
    $totalAmount = $_POST['totalAmountAfterTaxesInput'];
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
    $Upiid = $_POST['Upiid'];


    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }


    $stmt->close();
    $conn->close();
}
