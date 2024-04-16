<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "menu";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

$rowId = isset($_GET['id'])? (int)$_GET['id'] : null;  // Cast to int to ensure id is an integer

if (!$rowId) {
    die("Invalid data sent from the client");
}

$selectSql = "SELECT * FROM booking WHERE id =?";
$selectStmt = $conn->prepare($selectSql);
$selectStmt->bind_param("i", $rowId);

if (!$selectStmt->execute()) {
    die("Error fetching row: ". $selectStmt->error);
}

$result = $selectStmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Escape HTML special characters to prevent XSS
    foreach ($row as $key => $value) {
        $row[$key] = htmlspecialchars($value);
    }

    echo "ID: ". $row["id"]. "<br>";
    echo "Date: ". $row["date"]. "<br>";
    echo "Time: ". $row["time"]. "<br>";
    echo "Guest Title: ". $row["guestTitle"]. "<br>";
    echo "Guest Name: ". $row["guestName"]. "<br>";
    echo "Gender: ". $row["gender"]. "<br>";
    echo "Number: ". $row["number"]. "<br>";
    echo "Address: ". $row["address"]. "<br>";
    echo "City: ". $row["city"]. "<br>";
    echo "Pincode: ". $row["pincode"]. "<br>";
    echo "ID Proof: ". $row["idProof"]. "<br>";
    echo "Adharcard Number: ". $row["adharcardNumber"]. "<br>";
    echo "Pancard Number: ". $row["pancardNumber"]. "<br>";
    echo "Driving License Number: ". $row["drivinglicenseNumber"]. "<br>";
    echo "Passport Number: ". $row["passportNumber"]. "<br>";
    echo "Nationality: ". $row["nationality"]. "<br>";
    echo "Email: ". $row["email"]. "<br>";
    echo "RA Number: ". $row["raNumber"]. "<br>";
    echo "Company Name: ". $row["companyName"]. "<br>";
    echo "Check-in Date: ". $row["checkInDate"]. "<br>";
    echo "Arrival Time: ". $row["arrivalTime"]. "<br>";
    echo "Check-out Date: ". $row["checkOutDate"]. "<br>";
    echo "Departure Time: ". $row["departureTime"]. "<br>";
    echo "Adults: ". $row["adults"]. "<br>";
    echo "Children: ". $row["children"]. "<br>";
    echo "Room Type: ". $row["roomType"]. "<br>";
    echo "Room Number: ". $row["roomNumber"]. "<br>";
    echo "Plan: ". $row["plan"]. "<br>";
    echo "Guest Status: ". $row["guestStatus"]. "<br>";
    echo "Billing Instruction: ". $row["billingInstruction"]. "<br>";
    echo "Discount: ". $row["discount"]. "<br>";
    echo "Advance: ". $row["advance"]. "<br>";
    echo "Room Charge: ". $row["roomCharge"]. "<br>";
    echo "Food Charge: ". $row["foodCharge"]. "<br>";
    echo "CGST Percentage: ". $row["cgstPercentage"]. "<br>";
    echo "SGST Percentage: ". $row["sgstPercentage"]. "<br>";
    echo "Extra Charge: ". $row["extraCharge"]. "<br>";
    echo "Total Amount: ". $row["totalAmount"]. "<br>";
    echo "Payment Mode: ". $row["paymentMode"]. "<br>";
    echo "Debit Card Number: ". $row["debitCardNumber"]. "<br>";
    echo "Debit Card Holder: ". $row["debitCardHolder"]. "<br>";
    echo "Debit Card Expiry: ". $row["debitCardExpiry"]. "<br>";
    echo "Debit Card CVV: ". $row["debitCardCVV"]. "<br>";
    echo "Credit Card Type: ". $row["creditCardType"]. "<br>";
    echo "Credit Card Number: ". $row["creditCardNumber"]. "<br>";
    echo "Credit Card Holder: ". $row["creditCardHolder"]. "<br>";
    echo "Credit Card Expiry: ". $row["creditCardExpiry"]. "<br>";
    echo "Credit Card CVV: ". $row["creditCardCVV"]. "<br>";
    echo "UPI ID: ". $row["Upiid"]. "<br>";
    echo "<br>";
} else {
    die("No records found with id $rowId");
}

$selectStmt->close();
$conn->close();