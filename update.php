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

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize the input
    $rowId = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($rowId === null || $rowId <= 0) {
        die("Invalid data sent from the client");
    }

    // Prepare and execute select query
    $selectSql = "SELECT * FROM booking WHERE id = ?";
    $selectStmt = $conn->prepare($selectSql);
    $selectStmt->bind_param("i", $rowId);

    if (!$selectStmt->execute()) {
        die("Error fetching row: " . $selectStmt->error);
    }

    // Bind result variables
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
        $Upiid,
        $rowId
    );
    

    // Fetch data
    $selectStmt->fetch();

    // Close select statement
    $selectStmt->close();

    // Include booking form
    include('booking.php');

    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare update query
        $updateSql = "UPDATE booking SET date = ?, time = ?, guestTitle = ?, guestName = ?, gender = ?, number = ?, address = ?, city = ?, pincode = ?, idProof = ?, adharcardNumber = ?, pancardNumber = ?, drivinglicenseNumber = ?, passportNumber = ?, nationality = ?, email = ?, raNumber = ?, companyName = ?, checkInDate = ?, arrivalTime = ?, checkOutDate = ?, departureTime = ?, adults = ?, children = ?, roomType = ?, roomNumber = ?, plan = ?, guestStatus = ?, billingInstruction = ?, discount = ?, advance = ?, roomCharge = ?, foodCharge = ?, cgstPercentage = ?, sgstPercentage = ?, extraCharge = ?, totalAmount = ?, paymentMode = ?, debitCardNumber = ?, debitCardHolder = ?, debitCardExpiry = ?, debitCardCVV = ?, creditCardType = ?, creditCardNumber = ?, creditCardHolder = ?, creditCardExpiry = ?, creditCardCVV = ?, Upiid = ? WHERE id = ?";

        // Prepare and bind update statement
        $updateStmt = $conn->prepare($updateSql);

        $updateStmt->bind_param(
            "ssssssssssssssssssssssssssssssssssssssi",
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

        // Execute update statement
        if (!$updateStmt->execute()) {
            die("Error updating row: " . $updateStmt->error);
        }

        // Close update statement
        $updateStmt->close();

        echo "Row updated successfully!";
    }

    // Close connection
    $conn->close();
    ?>
</body>

</html>