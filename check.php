<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckIn</title>
    <link rel="stylesheet" href="./style11.css">
    <script>
        var now = new Date();
        var formattedTime = now.toISOString().slice(11, 16);
        document.getElementById('myTime').value = formattedTime;

        var formattedTime1 = now.toISOString().slice(11, 16);
        document.getElementById('arrivalTime').value = formattedTime1;

        var formattedTime2 = now.toISOString().slice(11, 16);
        document.getElementById('departureTime').value = formattedTime2;

        function showContent(contentId) {
            var contents = document.querySelectorAll('.content');
            contents.forEach(function(content) {
                content.classList.remove('show');
            });

            var selectedContent = document.getElementById('content-' + contentId);
            if (selectedContent) {
                selectedContent.classList.add('show');
            }

            var roomOptions = document.querySelector('.room-options');
            roomOptions.style.display = contentId === 'room' ? 'block' : 'none';
        }

        function showPaymentDetails() {
            var paymentMode = document.getElementById('paymentMode').value;
            document.getElementById('debitCardDetails').style.display = 'none';
            document.getElementById('creditCardDetails').style.display = 'none';
            document.getElementById('upi_details').style.display = 'none';

            if (paymentMode === 'debit') {
                document.getElementById('debitCardDetails').style.display = 'block';
            } else if (paymentMode === 'credit') {
                document.getElementById('creditCardDetails').style.display = 'block';
            } else if (paymentMode === 'upi') {
                document.getElementById('upi_details').style.display = 'block';
            }
        }

        function calculateTaxes() {


            var roomCharge = parseFloat(document.getElementById('roomCharge').value) || 0;
            var cgstPercentage = parseFloat(document.getElementById('cgst').value) || 0;
            var sgstPercentage = parseFloat(document.getElementById('sgst').value) || 0;
            var discountPercentage = parseFloat(document.getElementById('discount').value) || 0;
            var advance = parseFloat(document.getElementById('advance').value) || 0;

            var discountAmount = roomCharge * (discountPercentage / 100);
            var foodCharge = parseFloat(document.getElementById('foodcharge').value) || 0;
            var cgstAmount = (roomCharge - discountAmount + foodCharge) * (cgstPercentage / 100);
            var sgstAmount = (roomCharge - discountAmount + foodCharge) * (sgstPercentage / 100);
            var extraCharge = parseFloat(document.getElementById('extracharge').value) || 0;

            var totalAmount = roomCharge - discountAmount + foodCharge + cgstAmount + sgstAmount + extraCharge - advance;

            document.getElementById('discountAmount').value = discountAmount.toFixed(2);
            document.getElementById('cgstAmountInput').value = cgstAmount.toFixed(2);
            document.getElementById('sgstAmountInput').value = sgstAmount.toFixed(2);
            document.getElementById('totalAmountAfterTaxesInput').value = totalAmount.toFixed(2);
            // var roomCharge = parseFloat(document.getElementById('roomCharge').value);
            // var cgstPercentage = parseFloat(document.getElementById('cgst').value);
            // var sgstPercentage = parseFloat(document.getElementById('sgst').value);
            // var discountPercentage = parseFloat(document.getElementById('discount').value);
            // var advance = parseFloat(document.getElementById('advance').value);

            // var discountAmount = roomCharge * (discountPercentage / 100);
            // var foodCharge = parseFloat(document.getElementById('foodcharge').value);
            // var cgstAmount = (roomCharge - discountAmount + foodCharge) * (cgstPercentage / 100);
            // var sgstAmount = (roomCharge - discountAmount + foodCharge) * (sgstPercentage / 100);
            // var extraCharge = parseFloat(document.getElementById('extracharge').value);

            // var totalAmount = roomCharge - discountAmount + foodCharge + cgstAmount + sgstAmount + extraCharge -
            //     advance;

            // document.getElementById('discountAmount').value = discountAmount.toFixed(2);
            // document.getElementById('cgstAmountInput').value = cgstAmount.toFixed(2);
            // document.getElementById('sgstAmountInput').value = sgstAmount.toFixed(2);
            // document.getElementById('totalAmountAfterTaxesInput').value = totalAmount.toFixed(2);
        }


        function showIdProofDetails() {
            var idProof = document.getElementById('idproof').value;
            var adharcardDetails = document.getElementById('adharcardDetails');
            var pancardDetails = document.getElementById('pancardDetails');
            var drivinglicenseDetails = document.getElementById('drivinglicenseDetails');
            var passportDetails = document.getElementById('passportDetails');

            adharcardDetails.style.display = idProof === 'adharcard' ? 'block' : 'none';
            pancardDetails.style.display = idProof === 'pancard' ? 'block' : 'none';
            drivinglicenseDetails.style.display = idProof === 'drivinglicense' ? 'block' : 'none';
            passportDetails.style.display = idProof === 'passport' ? 'block' : 'none';
        }

        document.addEventListener("DOMContentLoaded", function() {
            const table = document.getElementById('dataTable');

            table.addEventListener('click', function(e) {
                const row = e.target.closest('tr');
                if (row && table.contains(row)) { // Check if the clicked element is a row within the table
                    const rowId = row.cells[0].textContent;
                    fetchData(rowId);
                }
            });
        });

        function fetchData(rowId) {
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    // Handling the response here
                    console.log(this.responseText);
                }
            };
            xhttp.open("GET", `fetgue.php?id=${rowId}`, true);
            xhttp.send();
        }
    </script>
</head>

<body>
    <div id="sidebar"></div>
    <div class="container">
        <form action="connect.php" method="post" onsubmit="calculateTaxes();">
            <h2><i>Check In</i></h2>
            <div class="checkinwrap">
                <div class="checkinbx firstcheckbx">
                    <div class="checkincontainer">
                        <label for="checkInDate"><b>Check In Date</b></label>
                        <input type="date" id="checkInDate" name="checkInDate" value="<?php echo isset($checkInDate) ? $checkInDate : ""; ?>"><br>
                        <label for="myTime"><b> Arrival Time</b></label>
                        <input type="time" id="myTime" name="arrivalTime" value="<?php echo isset($arrivalTime) ? $arrivalTime : ""; ?>">
                        <label for="checkOutDate"><b>Check Out Date</b></label>
                        <input type="date" id="checkOutDate" name="checkOutDate" value="<?php echo isset($checkOutDate) ? $checkOutDate : ""; ?>"><br>
                        <label for="myTime"><b>Departure Time</b></label>
                        <input type="time" id="myTime" name="departureTime" value="<?php echo isset($departureTime) ? $departureTime : ""; ?>">
                    </div>
                    <div class="checkincontainer">
                        <label for="guesttitle"><b>Guest Title</b></label>
                        <select id="guesttitle" name="guestTitle" value="<?php echo isset($guestTitle) ? $guestTitle : ""; ?>">
                            <option value=" "> </option>
                            <option value="Mr" <?php if (isset($guestTitle) && $guestTitle == "Mr") echo "selected"; ?>>Mr.</option>
                            <option value="Ms" <?php if (isset($guestTitle) && $guestTitle == "Ms") echo "selected"; ?>>Ms.</option>
                            <option value="Miss" <?php if (isset($guestTitle) && $guestTitle == "Miss") echo "selected"; ?>>Miss.</option>
                        </select><br>
                        <label for="guestName"><b>Guest Name</b></label>
                        <input type="text" id="guestName" name="guestName" placeholder="Guest Name" value="<?php echo isset($guestName) ? $guestName : ""; ?>"> <br>
                        <label for="gender"><b>Gender</b></label>
                        <select id="gender" name="gender" value="<?php echo isset($gender) ? $gender : ""; ?>">
                            <option value=" "> </option>
                            <option value="male" <?php if (isset($gender) && $gender == "male") echo "selected"; ?>>Male</option>
                            <option value="female" <?php if (isset($gender) && $gender == "female") echo "selected"; ?>>Female</option>
                            <option value="other" <?php if (isset($gender) && $gender == "other") echo "selected"; ?>>Other</option>
                        </select><br>
                        <label for="number"><b>Contact Number</b> </label>
                        <input type="number" id="number" name="number" placeholder="Contact Number" value="<?php echo isset($number) ? $number : ""; ?>"> <br>
                    </div>
                    <div class="checkincontainer">
                        <label for="address"><b>Address</b></label>
                        <input type="text" id="address" name="address" placeholder="Address" value="<?php echo isset($address) ? $address : ""; ?>"> <br>
                        <label for="city"><b>City</b></label>
                        <input type="text" id="city" name="city" placeholder="City" value="<?php echo isset($city) ? $city : ""; ?>"> <br>
                        <label for="pincode"><b>Pin Code</b> </label>
                        <input type="number" id="pincode" name="pincode" placeholder="Pin Code" value="<?php echo isset($pincode) ? $pincode : ""; ?>"> <br>
                        <label for="idproof"><b>ID Proof</b></label>
                        <select id="idproof" name="idproof" onchange="showIdProofDetails()" value="<?php echo $idProof; ?>">
                            <option value=" "> </option>
                            <option value="adharcard" <?php if (isset($idProof) && $idProof == "adharcard") echo "selected"; ?>>Adhar Card</option>
                            <option value="pancard" <?php if (isset($idProof) && $idProof == "pancard") echo "selected"; ?>>Pan Card</option>
                            <option value="drivinglicense" <?php if (isset($idProof) && $idProof == "drivinglicense") echo "selected"; ?>>Driving License</option>
                            <option value="passport" <?php if (isset($idProof) && $idProof == "passport") echo "selected"; ?>>Passport</option>
                        </select><br>

                        <div id="adharcardDetails" style="display:none;">
                            <label for="adharcardNumber"><b>Adhar Card Number</b></label>
                            <input type="text" id="adharcardNumber" name="adharcardNumber" placeholder="Adhar Card" value="<?php echo isset($adharcardNumber) ? $adharcardNumber : ""; ?>"><br>
                        </div>

                        <div id="pancardDetails" style="display:none;">
                            <label for="pancardNumber"><b>Pan Card Number</b></label>
                            <input type="text" id="pancardNumber" name="pancardNumber" placeholder="Pan Card" value="<?php echo isset($pancardNumber) ? $pancardNumber : ""; ?>"><br>
                        </div>

                        <div id="drivinglicenseDetails" style="display:none;">
                            <label for="drivinglicenseNumber"><b>Driving License Number</b></label>
                            <input type="text" id="drivinglicenseNumber" name="drivinglicenseNumber" placeholder="Driving License" value="<?php echo isset($drivinglicenseNumber) ? $drivinglicenseNumber : ""; ?>"><br>
                        </div>

                        <div id="passportDetails" style="display:none;">
                            <label for="passportNumber"><b>Passport Number</b></label>
                            <input type="text" id="passportNumber" name="passportNumber" placeholder="Passport" value="<?php echo isset($passportNumber) ? $passportNumber : ""; ?>"><br>
                        </div>
                    </div>
                    <div class="checkincontainer ">
                        <label for="nationality"><b>Nationality</b></label>
                        <input type="text" placeholder="Nationality" name="nationality" value="<?php echo isset($nationality) ? $nationality : ""; ?>"><br>
                        <label for="email"><b>Email</b></label>
                        <input type="email" id="email" name="email" placeholder="Email" value="<?php echo isset($email) ? $email : ""; ?>"> <br>

                        <label for="company"><b>Company Name</b></label>
                        <input type="text" placeholder="Company Name" name="company" value="<?php echo isset($companyName) ? $companyName : ""; ?>"><br>
                    </div>
                </div>
                <h2><b><i>Room Details</i></u></b></h2>
                <div class="checkinbx seccheckbx">
                    <div class="roominbx1">
                        <label for="roomtype"><b>Room Type</b></label>
                        <select id="roomtype" name="roomtype" value="<?php echo isset($roomType) ? $roomType : ""; ?>">
                            <option value=" "> </option>
                            <option value="single room ac" <?php if (isset($roomType) && $roomType == "single room ac") echo "selected"; ?>>Single Room AC</option>
                            <option value="double room ac" <?php if (isset($roomType) && $roomType == "double room ac") echo "selected"; ?>>Double Room AC</option>
                            <option value="deluxe room ac" <?php if (isset($roomType) && $roomType == "deluxe room ac") echo "selected"; ?>>Deluxe Room</option>
                            <option value="executive room ac" <?php if (isset($roomType) && $roomType == "executive room ac") echo "selected"; ?>>Executive Suite</option>
                            <option value="president suite ac" <?php if (isset($roomType) && $roomType == "president suite ac") echo "selected"; ?>>Presidential Suite</option>
                            <option value="single room non-ac" <?php if (isset($roomType) && $roomType == "single room non-ac") echo "selected"; ?>>Single Room NON AC</option>
                            <option value="double room non-ac" <?php if (isset($roomType) && $roomType == "double room non-ac") echo "selected"; ?>>Double Room NON AC</option>
                        </select><br>
                        <label for="roomumber"><b>Room No.</b></label>
                        <select id="room" name="room" value="<?php echo isset($roomNumber) ? $roomNumber : ""; ?>">
                            <option value=" "> </option>
                            <option value="101" <?php if (isset($roomNumber) && $roomNumber == "101") echo "selected"; ?>>101</option>
                            <option value="102" <?php if (isset($roomNumber) && $roomNumber == "102") echo "selected"; ?>>102</option>
                            <option value="103" <?php if (isset($roomNumber) && $roomNumber == "103") echo "selected"; ?>>103</option>
                            <option value="104" <?php if (isset($roomNumber) && $roomNumber == "104") echo "selected"; ?>>104</option>
                            <option value="105" <?php if (isset($roomNumber) && $roomNumber == "105") echo "selected"; ?>>105</option>
                            <option value="106" <?php if (isset($roomNumber) && $roomNumber == "106") echo "selected"; ?>>106</option>
                            <option value="107" <?php if (isset($roomNumber) && $roomNumber == "107") echo "selected"; ?>>107</option>
                            <option value="108" <?php if (isset($roomNumber) && $roomNumber == "108") echo "selected"; ?>>108</option>
                            <option value="109" <?php if (isset($roomNumber) && $roomNumber == "109") echo "selected"; ?>>109</option>
                            <option value="110" <?php if (isset($roomNumber) && $roomNumber == "110") echo "selected"; ?>>110</option>
                        </select><br>
                        <label for="plan"><b>Plan</b></label>
                        <select id="plan" name="plan" value="<?php echo isset($plan) ? $plan : ""; ?>">
                            <option value=" "> </option>
                            <option value="ep" <?php if (isset($plan) && $plan == "ep") echo "selected"; ?>>EP</option>
                            <option value="map" <?php if (isset($plan) && $plan == "map") echo "selected"; ?>>MAP</option>
                            <option value="ap" <?php if (isset($plan) && $plan == "ap") echo "selected"; ?>>AP</option>
                            <option value="full board" <?php if (isset($plan) && $plan == "full board") echo "selected"; ?>>Full Board</option>
                            <option value="room only" <?php if (isset($plan) && $plan == "room only") echo "selected"; ?>>Room Only</option>
                        </select><br>
                    </div>
                </div>
                <h2><b><i>Payment Mode</i></u></b></h2>
                <div class="checkinbx">
                    <div class="checkincontainer">
                        <label for="billinstruction"><b>Billing Instruction</b></label>
                        <select id="billinstruction" name="billinstruction" value="<?php echo isset($billingInstruction) ? $billingInstruction : ""; ?>">
                            <option value=" "> </option>
                            <option value="buildtocompany" <?php if (isset($billingInstruction) && $billingInstruction == "buildtocompany") echo "selected"; ?>>Build to Company</option>
                            <option value="directpaymentbyguest" <?php if (isset($billingInstruction) && $billingInstruction == "directpaymentbyguest") echo "selected"; ?>>Direct Payment by Guest</option>
                            <option value="guestroomterif+foodfromcompany" <?php if (isset($billingInstruction) && $billingInstruction == "guestroomterif+foodfromcompany") echo "selected"; ?>>Guest Room Terif + Food From Company</option>
                            <option value="companyroomterif+foodbyself" <?php if (isset($billingInstruction) && $billingInstruction == "companyroomterif+foodbyself") echo "selected"; ?>>Company Room Terif + Food By Self</option>
                        </select><br>
                        <label for="discount"><b>Discount (%)</b></label>
                        <input type="number" id="discount" name="discount" placeholder="Discount Percentage" oninput="calculateTaxes()" value="<?php echo isset($discount) ? $discount : ""; ?>"><br>
                        <label for="advance"><b>Advance</b></label>
                        <input type="number" id="advance" name="advance" placeholder="Advance" oninput="calculateTaxes()" value="<?php echo isset($advance) ? $advance : ""; ?>"><br>
                        <label for="roomCharge"><b>Room Charge</b></label>
                        <input type="number" id="roomCharge" name="roomCharge" placeholder="Room Charge" oninput="calculateTaxes()" value="<?php echo isset($roomCharge) ? $roomCharge : ""; ?>"><br>
                    </div>
                    <div class="checkincontainer">
                        <label for="foodcharge"><b>Food Charge</b></label>
                        <input type="number" id="foodcharge" name="foodcharge" placeholder="Food Charge" oninput="calculateTaxes()" value="<?php echo isset($foodCharge) ? $foodCharge : ""; ?>"><br>
                        <label for="cgst"><b>CGST %</b></label>
                        <input type="number" id="cgst" name="cgst" placeholder="CGST Percentage" oninput="calculateTaxes()" value="<?php echo isset($cgstPecentage) ? $cgstPecentage : ""; ?>"><br>
                        <label for="sgst"><b>SGST %</b></label>
                        <input type="number" id="sgst" name="sgst" placeholder="SGST Percentage" oninput="calculateTaxes()" value="<?php echo isset($sgstPercentage) ? $sgstPercentage : ""; ?>"><br>
                        <label for="discountAmount"><b>Discount Amount</b></label>
                        <input type="text" name="discountAmount" id="discountAmount" placeholder="Discount Amount" value="<?php echo isset($discountAmount) ? $discountAmount : ""; ?>" readonly><br>
                    </div>
                    <div class="checkincontainer">
                        <label for="cgstAmountInput"><b>CGST Amount</b></label>
                        <input type="text" name="cgstAmountInput" id="cgstAmountInput" placeholder="CGST Amount" value="<?php echo isset($cgstAmount) ? $cgstAmount : ""; ?>" readonly><br>
                        <label for="sgstAmountInput"><b>SGST Amount</b></label>
                        <input type="text" name="sgstAmountInput" id="sgstAmountInput" placeholder="SGST Amount" value="<?php echo isset($sgstAmount) ? $sgstAmount : ""; ?>" readonly><br>
                        <label for="extracharge"><b>Extra Charge</b></label>
                        <input type="number" id="extracharge" name="extracharge" placeholder="Extra Charge" oninput="calculateTaxes()" value="<?php echo isset($extraCharge) ? $extraCharge : ""; ?>"><br>
                        <label for="totalAmountAfterTaxesInput"><b>Total Amount</b></label>
                        <input type="text" id="totalAmountAfterTaxesInput" name="totalAmount" placeholder="Total Amount" value="<?php echo isset($totalAmount) ? $totalAmount : ""; ?>" readonly><br>
                    </div>
                    <div class="checkincontainer">
                        <label for="paymentMode"><b>Payment Mode</b></label>
                        <select id="paymentMode" name="paymentMode" onchange="showPaymentDetails()" value="<?php echo isset($paymentMode) ? $paymentMode : ""; ?>">
                            <option value=" "> </option>
                            <option value="cash" <?php if (isset($paymentMode) && $paymentMode == "cash") echo "selected"; ?>>Cash</option>
                            <option value="debit" <?php if (isset($paymentMode) && $paymentMode == "debit") echo "selected"; ?>>Debit Card</option>
                            <option value="credit" <?php if (isset($paymentMode) && $paymentMode == "credit") echo "selected"; ?>>Credit Card</option>
                            <option value="upi" <?php if (isset($paymentMode) && $paymentMode == "upi") echo "selected"; ?>>UPI</option>
                        </select><br>

                        <div id="debitCardDetails" style="display:none;">
                            <label for="debitCardNumber"><b>Debit Card Number</b></label>
                            <input type="text" id="debitCardNumber" name="debitCardNumber" placeholder="Enter Debit Card Number" value="<?php echo isset($debitCardNumber) ? $debitCardNumber : ""; ?>"><br>
                            <label for="debitCardHolder"><b>Cardholder Name</b></label>
                            <input type="text" id="debitCardHolder" name="debitCardHolder" placeholder="Enter Cardholder Name" value="<?php echo isset($debitCardHolder) ? $debitCardHolder : ""; ?>"><br>
                            <label for="debitCardExpiry"><b>Expiry Date</b></label>
                            <input type="text" id="debitCardExpiry" name="debitCardExpiry" placeholder="MM/YY" value="<?php echo isset($debitCardExpiry) ? $debitCardExpiry : ""; ?>"><br>
                            <label for="debitCardCVV"><b>CVV</b></label>
                            <input type="text" id="debitCardCVV" name="debitCardCVV" placeholder="CVV" value="<?php echo isset($debitCardCVV) ? $debitCardCVV : ""; ?>"><br>
                        </div>


                        <div id="creditCardDetails" style="display:none;">
                            <label for="creditCardType"><b>Card Type</b></label>
                            <select id="creditCardType" name="creditCardType" value="<?php echo isset($creditCardType) ? $$creditCardType : ""; ?>">
                                <option value=" "> </option>
                                <option value="visa" <?php if (isset($creditCardType) && $creditCardType == "visa") echo "selected"; ?>>Visa</option>
                                <option value="rupay" <?php if (isset($creditCardType) && $creditCardType == "rupay") echo "selected"; ?>>RuPay</option>
                                <option value="mastercard" <?php if (isset($creditCardType) && $creditCardType == "mastercard") echo "selected"; ?>>MasterCard</option>
                                <option value="amex" <?php if (isset($creditCardType) && $creditCardType == "amex") echo "selected"; ?>>American Express</option>
                            </select><br>
                            <label for="creditCardNumber"><b>Credit Card Number</b></label>
                            <input type="text" id="creditCardNumber" name="creditCardNumber" placeholder="Enter Credit Card Number" value="<?php echo isset($creditCardNumber) ? $creditCardNumber : ""; ?>"><br>
                            <label for="creditCardHolder"><b>Cardholder Name</b></label>
                            <input type="text" id="creditCardHolder" name="creditCardHolder" placeholder="Enter Cardholder Name" value="<?php echo isset($creditCardHolder) ? $creditCardHolder : ""; ?>"><br>
                            <label for="creditCardExpiry"><b>Expiry Date</b></label>
                            <input type="text" id="creditCardExpiry" name="creditCardExpiry" placeholder="MM/YY" value="<?php echo isset($creditCardExpiry) ? $creditCardExpiry : ""; ?>"><br>
                            <label for="creditCardCVV"><b>CVV</b></label>
                            <input type="text" id="creditCardCVV" name="creditCardCVV" placeholder="CVV" value="<?php echo isset($creditCardCVV) ? $creditCardCVV : ""; ?>"><br>
                        </div>
                        <div id="upi_details" style="display: none;">
                            <label for="upiid"><b>UPI ID</b></label>
                            <input type="number" name="Upiid" placeholder="UPI ID" value="<?php echo isset($Upiid) ? $Upiid : ""; ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="btnwrappper">
                <button type="submit" name="submit" value="update"><b>Update</b></button>
                <button type="submit" name="submit" value="submit"><b>Submit</b></button>
                <button type="reset"><b>Cancel</b></button><br>
            </div>
        </form>
    </div>

    <script>
        calculateTaxes()

        function includeContent(url, targetId) {
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    document.getElementById(targetId).innerHTML =
                        data;
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                });
        }
        includeContent('menu.html', 'sidebar');
    </script>


</body>

</html>