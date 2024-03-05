<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style11.css">
    <title>Update Data</title>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "menu";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $rowId = isset($_GET['id']) ? $_GET['id'] : null;

    if ($rowId === null) {
        die("Invalid data sent from the client");
    }

    $selectSql = "SELECT 
        date, time, guestTitle, guestName, gender, number, address, city, pincode, idProof,
        adharcardNumber, pancardNumber, drivinglicenseNumber, passportNumber, nationality, email, 
        raNumber, companyName, checkInDate, arrivalTime, checkOutDate, departureTime, 
        adults, children, roomType, roomNumber, plan, guestStatus, billingInstruction, 
        discount, advance, roomCharge, foodCharge, cgstPercentage, sgstPercentage, 
        extraCharge, totalAmount, paymentMode, debitCardNumber,
        debitCardHolder, debitCardExpiry, debitCardCVV, 
        creditCardType, creditCardNumber, creditCardHolder, creditCardExpiry,
        creditCardCVV, Upiid 
        FROM booking WHERE id = ?";
    $selectStmt = $conn->prepare($selectSql);
    $selectStmt->bind_param("i", $rowId);

    if (!$selectStmt->execute()) {
        die("Error fetching row: " . $selectStmt->error);
    }

    $selectStmt->bind_result(
        $date,
        $time,
        $guestTitle,
        $guestName,
        $gender,
        $number,
        $address,
        $city,
        $pincode,
        $idProof,
        $adharcardNumber,
        $pancardNumber,
        $drivinglicenseNumber,
        $passportNumber,
        $nationality,
        $email,
        $raNumber,
        $companyName,
        $checkInDate,
        $arrivalTime,
        $checkOutDate,
        $departureTime,
        $adults,
        $children,
        $roomType,
        $roomNumber,
        $plan,
        $guestStatus,
        $billingInstruction,
        $discount,
        $advance,
        $roomCharge,
        $foodCharge,
        $cgstPercentage,
        $sgstPercentage,
        $extraCharge,
        $totalAmount,
        $paymentMode,
        $debitCardNumber,
        $debitCardHolder,
        $debitCardExpiry,
        $debitCardCVV,
        $creditCardType,
        $creditCardNumber,
        $creditCardHolder,
        $creditCardExpiry,
        $creditCardCVV,
        $Upiid
    );

    $selectStmt->fetch();

    $selectStmt->close();

    include('booking.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $updateSql = "UPDATE booking SET 
            date = ?, time = ?, guestTitle = ?, guestName = ?, gender = ?, number = ?, 
            address = ?, city = ?, pincode = ?, idProof = ?, adharcardNumber = ?, 
            pancardNumber = ?, drivinglicenseNumber = ?, passportNumber = ?, nationality = ?, 
            email = ?, raNumber = ?, companyName = ?, checkInDate = ?, arrivalTime = ?, 
            checkOutDate = ?, departureTime = ?, adults = ?, children = ?, roomType = ?, 
            roomNumber = ?, plan = ?, guestStatus = ?, billingInstruction = ?, discount = ?, 
            advance = ?, roomCharge = ?, foodCharge = ?, cgstPercentage = ?, sgstPercentage = ?, 
            extraCharge = ?, totalAmount = ?, paymentMode = ?, debitCardNumber = ?, 
            debitCardHolder = ?, debitCardExpiry = ?, debitCardCVV = ?, creditCardType = ?, 
            creditCardNumber = ?, creditCardHolder = ?, creditCardExpiry = ?, 
            creditCardCVV = ?, Upiid = ? WHERE id = ?";

        $updateStmt = $conn->prepare($updateSql);

        $updateStmt->bind_param(
            "sssssssssssssssssssssssssssssssssssssssi",
            $_POST['date'],
            $_POST['time'],
            $_POST['guestTitle'],
            $_POST['guestName'],
            $_POST['gender'],
            $_POST['number'],
            $_POST['address'],
            $_POST['city'],
            $_POST['pincode'],
            $_POST['idProof'],
            $_POST['adharcardNumber'],
            $_POST['pancardNumber'],
            $_POST['drivinglicenseNumber'],
            $_POST['passportNumber'],
            $_POST['nationality'],
            $_POST['email'],
            $_POST['raNumber'],
            $_POST['companyName'],
            $_POST['checkInDate'],
            $_POST['arrivalTime'],
            $_POST['checkOutDate'],
            $_POST['departureTime'],
            $_POST['adults'],
            $_POST['children'],
            $_POST['roomType'],
            $_POST['roomNumber'],
            $_POST['plan'],
            $_POST['guestStatus'],
            $_POST['billingInstruction'],
            $_POST['discount'],
            $_POST['advance'],
            $_POST['roomCharge'],
            $_POST['foodCharge'],
            $_POST['cgstPercentage'],
            $_POST['sgstPercentage'],
            $_POST['extraCharge'],
            $_POST['totalAmount'],
            $_POST['paymentMode'],
            $_POST['debitCardNumber'],
            $_POST['debitCardHolder'],
            $_POST['debitCardExpiry'],
            $_POST['debitCardCVV'],
            $_POST['creditCardType'],
            $_POST['creditCardNumber'],
            $_POST['creditCardHolder'],
            $_POST['creditCardExpiry'],
            $_POST['creditCardCVV'],
            $_POST['Upiid'],
            $rowId
        );

        if (!$updateStmt->execute()) {
            die("Error updating row: " . $updateStmt->error);
        }

        $updateStmt->close();

        echo "Row updated successfully!";
    }

    $conn->close();
    ?>
</body>

</html>