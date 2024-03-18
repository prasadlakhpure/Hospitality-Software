<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Branch</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            width: 100%;
            background-color: #34495e;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 0;
        }

        .navbar button {
            margin: 5px;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #e74c3c;
            color: white;
            cursor: pointer;
            border: none;
        }

        .navbar button:hover {
            background-color: #c0392b;
        }

        #output {
            padding: 20px;
        }

        .commontable {
            margin-top: 20px;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: #3498db;
            color: white;
        }

        #roomDiscriptionMaster {
            width: 45%;
            margin: 0 auto;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            z-index: 1;
        }

        .popup-content {
            text-align: center;
        }

        .popup input {
            margin-bottom: 10px;
        }

        .selected {
            background-color: #e0e0e0;
        }
    </style>
</head>

<body>
    <div id="sidebar"></div>
    <div class="content" id="contentmaster">

        <div class="navbar">
            <div class="navbar">
                <button onclick="roomdescriptionmaster()"><b>Room Description Master</b></button>
                <button onclick="billinstruction()"><b>Bill Instruction</b></button>
                <button onclick="creditcardmaster()"><b>Credit Card Master</b></button>
                <button onclick="currencymaster()"><b>Currency Master</b></button>
                <button onclick="companymaster()"><b>Company Master</b></button>
                <button onclick="countrymaster()"><b>Country Master</b></button>
                <button onclick="packagemaster()"><b>Package Master</b></button>
                <button onclick="CGSTandSGST()"><b>CGST and SGST</b></button>
                <!-- <button onclick="roomtypemaster()"><b>Room Type Master</b></button> -->
                <!-- <button onclick="categorymaster()"><b>Category Master</b></button> -->
            </div>
        </div>
        <div id="output"></div>
    </div>

    <script>
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

        function roomdescriptionmaster() {
            const roomDiscriptionMaster = `
        <div id="roomDiscriptionMaster">
            <h2><b> Room Description List</b></h2>
            <div class="commontable">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "menu";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT RoomID, RoomCode, RoomDescription FROM roommaster";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table>
                        <tr>
                            <th>Room ID</th>
                            <th>Room Code</th>
                            <th>Room Description</th>
                        </tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr data-roomid='{$row['RoomID']}' data-roomcode='{$row['RoomCode']}' onclick='selectRow(\"{$row['RoomCode']}\", \"{$row['RoomID']}\")'>
                                    <td>{$row['RoomID']}</td>
                                    <td>{$row['RoomCode']}</td>
                                    <td>{$row['RoomDescription']}</td>
                                </tr>";
                    }

                    echo "</table>";
                } else {
                    echo "No records found";
                }

                $conn->close();
                ?>
                <div class="button-container">
                    <button onclick="showInsertPopup()">Insert</button>
                    <button onclick="showModifyPopup()">Modify</button>
                    <button onclick="deleteRow()">Delete</button>
                    <button onclick="view()">View</button>
                    <button onclick="closeRoomDescription()">Close</button>
                </div>
            </div>
        </div>

        <div id="insertPopup" class="popup">
            <div class="popup-content">
              <form action="roommaster.php" method="post">
                <label for="roomID">Room ID</label>
                <input type="text" id="roomID" name="roomID"> <br>

                <label for="roomCode">Room Code</label>
                <input type="text" id="roomCode" name="roomCode"> <br>

                <label for="roomDescription">Room Description</label>
                <input type="text" id="roomDescription" name="roomDescription"> <br>

                <button onclick="insert()" name="submit" value="submit">Submit</button>
                <button onclick="closeInsertPopup()">Cancel</button>
              </form>
            </div>
        </div>

        <div id="modifyPopup" class="popup">
           <div class="popup-content">
             <form>
              <label for="modifyRoomID">Room ID</label>
              <input type="number" id="modifyRoomID" name="modifyRoomId"> <br>

              <label for="modifyRoomCode">Room Code</label>
              <input type="text" id="modifyRoomCode" name="modifyRoomCode"> <br>

              <label for="modifyRoomDescription">Room Description</label>
              <input type="text" id="modifyRoomDescription" name="modifyRoomDescription"> <br>

              <button onclick="update()" name="submit" value="submit">Update</button>
              <button onclick="closeModifyPopup()">Cancel</button>
             </form>
           </div>
        </div>
    `;
            document.getElementById('output').innerHTML = roomDiscriptionMaster;
        }

        function selectRow(roomCode, roomID) {
            var rows = document.querySelectorAll("table tr");
            for (var i = 0; i < rows.length; i++) {
                rows[i].classList.remove("selected");
            }

            var selectedRow = document.querySelector("tr[data-roomid='" + roomID + "']");
            if (selectedRow) {
                selectedRow.classList.add("selected");
            }
        }

        function showInsertPopup() {
            document.getElementById('insertPopup').style.display = 'block';
        }

        function closeInsertPopup() {
            document.getElementById('insertPopup').style.display = 'none';
        }

        function insert() {
            closeInsertPopup();
        }

        function showModifyPopup() {
            var table = document.querySelector("table");
            var selectedRow = table.querySelector(".selected");

            if (selectedRow) {
                var roomCode = selectedRow.cells[1].innerText;
                var roomDescription = selectedRow.cells[2].innerText;
                var roomID = selectedRow.cells[0].innerText;

                document.getElementById('modifyRoomID').value = roomID;
                document.getElementById('modifyRoomCode').value = roomCode;
                document.getElementById('modifyRoomDescription').value = roomDescription;

                document.getElementById('modifyPopup').style.display = 'block';
            } else {
                alert("Please select a row to modify.");
            }
        }

        function update() {
            var roomID = document.getElementById('modifyRoomID').value;
            var roomCode = document.getElementById('modifyRoomCode').value;
            var roomDescription = document.getElementById('modifyRoomDescription').value;

            var selectedRow = document.querySelector("tr[data-roomid='" + roomID + "']");
            selectedRow.cells[2].innerText = roomDescription;

            closeModifyPopup();

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        if (this.responseText.trim() === "Update successful") {
                            alert("Update successful");
                        } else {
                            alert("Failed to update the data. Please try again. Error: " + this.responseText);
                        }
                    } else {
                        alert("Failed to update the data. Please try again. Status: " + this.status);
                    }
                }
            };

            xhttp.open("POST", "roomupdate.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("roomID=" + encodeURIComponent(roomID) + "&roomCode=" + encodeURIComponent(roomCode) + "&roomDescription=" + encodeURIComponent(roomDescription));
        }

        function closeModifyPopup() {
            document.getElementById('modifyRoomID').value = '';
            document.getElementById('modifyRoomCode').value = '';
            document.getElementById('modifyRoomDescription').value = '';
            document.getElementById('modifyPopup').style.display = 'none';
        }

        function deleteRow() {
            var table = document.querySelector("table");
            var selectedRow = table.querySelector(".selected");

            if (selectedRow) {
                var roomID = selectedRow.cells[0].innerText;

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            selectedRow.remove();
                        } else {
                            alert("Failed to delete the row. Please try again.");
                        }
                    }
                };

                xhttp.open("POST", "roomdelete.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("roomId=" + encodeURIComponent(roomID));
            } else {
                alert("Please select a row to delete.");
            }
        }

        function view() {
            var table = document.querySelector("table");
            var selectedRow = table.querySelector(".selected");

            if (selectedRow) {
                var roomID = selectedRow.cells[0].innerText;
                var roomCode = selectedRow.cells[1].innerText;
                var roomDescription = selectedRow.cells[2].innerText;

                var details = "Room ID: " + roomID + "\nRoom Code: " + roomCode + "\nRoom Description: " + roomDescription;
                alert(details);
            } else {
                alert("Please select a row to view details.");
            }
        }

        function closeRoomDescription() {
            window.location.href = ' ';
        }



        function billinstruction() {
            const billInstruction = `
        <div id="billInstruction">
            <h2><b>Bill Instruction List</b></h2>
            <div class="commontable">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "menu";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT BillID, BillCode, BillDescription FROM billmaster";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
            <tr>
                <th>Bill ID</th>
                <th>Bill Code</th>
                <th>Bill Description</th>
            </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr data-billid='{$row['BillID']}' data-billcode='{$row['BillCode']}' onclick='highlightRow(\"{$row['BillCode']}\", \"{$row['BillID']}\")'>
                    <td>{$row['BillID']}</td>
                    <td>{$row['BillCode']}</td>
                    <td>{$row['BillDescription']}</td>
                </tr>";
            }

            echo "</table>";
        } else {
            echo "No records found";
        }

        $conn->close();
        ?>

        <div class="button-container">
            <button onclick="showInsertBillPopup()">Insert</button>
            <button onclick="showModifyBillPopup()">Modify</button>
            <button onclick="deleteBillRow()">Delete</button>
            <button onclick="viewBill()">View</button>
            <button onclick="closeBill()">Close</button>
        </div>
    </div>
</div>

<div id="insertBillPopup" class="popup">
    <div class="popup-content">
        <form action="billmaster.php" method="post">
             <label for="billID">Bill ID</label>
             <input type="text" id="billID" name="billID"> <br>

             <label for="billCode">Bill Code</label>
             <input type="text" id="billCode" name="billCode"> <br>

             <label for="billDescription">Bill Description</label>
             <input type="text" id="billDescription" name="billDescription"> <br>

            <button type="submit" name="submit">Submit</button>
            <button type="button" onclick="closeInsertBillPopup()">Cancel</button>
        </form>
    </div>
</div>

<div id="modifyBillPopup" class="popup">
    <div class="popup-content">
        <form action="billmaster.php" method="post">
             <label for="modifyBillID">Bill ID</label>
             <input type="number" id="modifyBillID" name="modifyBillID"> <br>

             <label for="modifyBillCode">Bill Code</label>
             <input type="text" id="modifyBillCode" name="modifyBillCode"> <br>

             <label for="modifyBillDescription">Bill Description</label>
             <input type="text" id="modifyBillDescription" name="modifyBillDescription"> <br>
            <button type="submit" name="modify" value="modify">Update</button>
            <button type="button" onclick="closeModifyBillPopup()">Cancel</button>
        </form>
    </div>
</div>
`;
            document.getElementById('output').innerHTML = billInstruction;
        }

        function highlightRow(billCode, billID) {
            var rows = document.querySelectorAll("table tr");
            for (var i = 0; i < rows.length; i++) {
                rows[i].classList.remove("selected");
            }

            var highlightedRow = document.querySelector("tr[data-billid='" + billID + "']");
            if (highlightedRow) {
                highlightedRow.classList.add("selected");
            }
        }

        function showInsertBillPopup() {
            document.getElementById('insertBillPopup').style.display = 'block';
        }

        function closeInsertBillPopup() {
            document.getElementById('insertBillPopup').style.display = 'none';
        }

        function showModifyBillPopup() {
            var highlightedRow = document.querySelector("table tr.selected");
            if (highlightedRow) {
                var billID = highlightedRow.getAttribute('data-billid');
                var billCode = highlightedRow.getAttribute('data-billcode');
                var billDescription = highlightedRow.cells[2].innerHTML;

                document.getElementById('modifyBillID').value = billID;
                document.getElementById('modifyBillCode').value = billCode;
                document.getElementById('modifyBillDescription').value = billDescription;

                document.getElementById('modifyBillPopup').style.display = 'block';
            } else {
                alert('Please select a bill to modify.');
            }
        }

        function closeModifyBillPopup() {
            document.getElementById('modifyBillPopup').style.display = 'none';
        }

        function deleteBillRow() {
            var table = document.querySelector("table");
            var highlightedRow = table.querySelector(".selected");

            if (highlightedRow) {
                var billID = highlightedRow.cells[0].innerText;

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            highlightedRow.remove();
                        } else {
                            alert("Failed to delete the row. Please try again.");
                        }
                    }
                };

                xhttp.open("POST", "billdelete.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("billId=" + encodeURIComponent(billID));
            } else {
                alert("Please select a row to delete.");
            }
        }

        function viewBill() {
            var table = document.querySelector("table");
            var selectedRow = table.querySelector(".selected");

            if (selectedRow) {
                var billID = selectedRow.getAttribute('data-billid');
                var billCode = selectedRow.cells[1].innerText;
                var billDescription = selectedRow.cells[2].innerText;

                var details = "Bill ID: " + billID + "\nBill Code: " + billCode + "\nBill Description: " + billDescription;
                alert(details);
            } else {
                alert("Please select a row to view details.");
            }
        }

        function closeBill() {
            window.location.href = '';
        }



        function creditcardmaster() {
            const creditCard = `
    <div id="creditCard">
        <h2><b>Credit Card List</b></h2>
        <div class="commontable">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "menu";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT CreditID, CreditCode, Description, CardLimit, Commission FROM creditmaster";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>
                <tr>
                    <th>Credit ID</th>
                    <th>Credit Code</th>
                    <th>Description</th>
                    <th>Card Limit</th>
                    <th>Commission</th>
                </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr data-creditcardid='{$row['CreditID']}' data-creditcode='{$row['CreditCode']}' onclick='highlightCreditCardRow(\"{$row['CreditID']}\")'>
                    <td>{$row['CreditID']}</td>
                    <td>{$row['CreditCode']}</td>
                    <td>{$row['Description']}</td>
                    <td>{$row['CardLimit']}</td>
                    <td>{$row['Commission']}</td>
                    </tr>";
                }

                echo "</table>";
            } else {
                echo "No records found";
            }

            $conn->close();
            ?>
            <div class="button-container">
                <button onclick="showInsertCreditCardPopup()">Insert</button>
                <button onclick="showModifyCreditCardPopup()">Modify</button>
                <button onclick="deleteCreditCard()">Delete</button>
                <button onclick="viewCreditCard()">View</button>
                <button onclick="closeCreditCard()">Close</button>
            </div>
        </div>
    </div>

    <div id="insertCreditCardPopup" class="popup">
        <div class="popup-content">
            <form action="creditmaster.php" method="post">
                <label for="creditID">Credit ID</label>
                <input type="text" id="creditID" name="creditID"> <br>

                <label for="creditCode">Credit Code</label>
                <input type="text" id="creditCode" name="creditCode"> <br>
                
                <label for="description">Description</label>
                <input type="text" id="description" name="description"> <br>

                <label for="cardLimit">Card Limit</label>
                <input type="text" id="cardLimit" name="cardLimit"> <br>

                <label for="commission">Commission</label>
                <input type="text" id="commission" name="commission"> <br>

                <button type="submit" name="submit">Submit</button>
                <button type="button" onclick="closeInsertCreditCardPopup()">Cancel</button>
            </form>
        </div>
    </div>

    <div id="modifyCreditCardPopup" class="popup">
        <div class="popup-content">
            <form action="creditmaster.php" method="post">
                <label for="modifyCreditID">Credit ID</label>
                <input type="text" id="modifyCreditID" name="modifyCreditID"> <br>

                <label for="modifyCreditCode">Credit Code</label>
                <input type="text" id="modifyCreditCode" name="modifyCreditCode"> <br>

                <label for="modifyDescription">Description</label>
                <input type="text" id="modifyDescription" name="modifyDescription"> <br>

                <label for="modifyCardLimit">Card Limit</label>
                <input type="text" id="modifyCardLimit" name="modifyCardLimit"> <br>

                <label for="modifyCommission">Commission</label>
                <input type="text" id="modifyCommission" name="modifyCommission"> <br>

                <button type="submit" name="modify" value="modify">Update</button>
                <button type="button" onclick="closeModifyCreditCardPopup()">Cancel</button>
            </form>
        </div>
    </div>
`;
            document.getElementById('output').innerHTML = creditCard;
        }

        function highlightCreditCardRow(creditCardID) {
            var rows = document.querySelectorAll("table tr");
            for (var i = 0; i < rows.length; i++) {
                rows[i].classList.remove("selected");
            }

            var highlightedRow = document.querySelector("tr[data-creditcardid='" + creditCardID + "']");
            if (highlightedRow) {
                highlightedRow.classList.add("selected");
            }
        }

        function showInsertCreditCardPopup() {
            document.getElementById('insertCreditCardPopup').style.display = 'block';
        }

        function closeInsertCreditCardPopup() {
            document.getElementById('insertCreditCardPopup').style.display = 'none';
        }

        function showModifyCreditCardPopup() {
            var highlightedRow = document.querySelector("table tr.selected");
            if (highlightedRow) {
                var creditCardID = highlightedRow.getAttribute('data-creditcardid');
                var creditCardCode = highlightedRow.cells[1].innerText;
                var description = highlightedRow.cells[2].innerText;
                var cardLimit = highlightedRow.cells[3].innerText;
                var commission = highlightedRow.cells[4].innerText;

                document.getElementById('modifyCreditID').value = creditCardID;
                document.getElementById('modifyCreditCode').value = creditCardCode;
                document.getElementById('modifyDescription').value = description;
                document.getElementById('modifyCardLimit').value = cardLimit;
                document.getElementById('modifyCommission').value = commission;

                document.getElementById('modifyCreditCardPopup').style.display = 'block';
            } else {
                alert('Please select a credit card to modify.');
            }
        }

        function closeModifyCreditCardPopup() {
            document.getElementById('modifyCreditCardPopup').style.display = 'none';
        }

        function deleteCreditCard() {
            var table = document.querySelector("table");
            var highlightedRow = table.querySelector(".selected");

            if (highlightedRow) {
                var creditCardID = highlightedRow.getAttribute('data-creditcardid');

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            highlightedRow.remove();
                        } else {
                            alert("Failed to delete the row. Please try again.");
                        }
                    }
                };

                xhttp.open("POST", "creditdelete.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("creditID=" + encodeURIComponent(creditCardID));
                alert("Please select a row to delete.");
            }
        }


        function viewCreditCard() {
            var table = document.querySelector("table");
            var selectedRow = table.querySelector(".selected");

            if (selectedRow) {
                var creditCardID = selectedRow.getAttribute('data-creditcardid');
                var creditCardCode = selectedRow.cells[1].innerText;
                var description = selectedRow.cells[2].innerText;
                var cardLimit = selectedRow.cells[3].innerText;
                var commission = selectedRow.cells[4].innerText;

                var details = "Credit Card ID: " + creditCardID + "\nCredit Card Code: " + creditCardCode + "\nDescription: " + description + "\nCard Limit: " + cardLimit + "\nCommission: " + commission;
                alert(details);
            } else {
                alert("Please select a row to view details.");
            }
        }

        function closeCreditCard() {
            window.location.href = '';
        }


        function currencymaster() {
            const currency = `
        <div id="currency">
            <h2><b>Currency List</b></h2>
            <div class="commontable">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "menu";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT CurrencyID, CountryName, CurrencyOfCountry FROM currencymaster";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>
                    <tr>
                        <th>Currency ID</th>
                        <th>Country Name</th>
                        <th>Currency of Country</th>
                    </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr data-currencyid='{$row['CurrencyID']}' data-countryname='{$row['CountryName']}' onclick='highlightCurrencyRow(\"{$row['CurrencyID']}\")'>
                        <td>{$row['CurrencyID']}</td>
                        <td>{$row['CountryName']}</td>
                        <td>{$row['CurrencyOfCountry']}</td>
                        </tr>";
                }

                echo "</table>";
            } else {
                echo "No records found";
            }

            $conn->close();
            ?>
                
                <div class="button-container">
                    <button onclick="showInsertCurrencyPopup()">Insert</button>
                    <button onclick="showModifyCurrencyPopup()">Modify</button>
                    <button onclick="deleteCurrency()">Delete</button>
                    <button onclick="viewCurrency()">View</button>
                    <button onclick="closeCurrency()">Close</button>
                </div>
            </div>
        </div>
        <div id="insertCurrencyPopup" class="popup">
        <div class="popup-content">
                <form action="currencymaster.php" method="post">
                    <label for="currencyID">Currency ID</label>
                    <input type="text" id="currencyID" name="currencyID"> <br>

                    <label for="countryName">Country Name</label>
                    <input type="text" id="countryName" name="countryName"> <br>
                        
                    <label for="currencyOfCountry">Currency of Country</label>
                    <input type="text" id="currencyOfCountry" name="currencyOfCountry"> <br>

                    <button type="submit" name="submit">Submit</button>
                    <button type="button" onclick="closeInsertCurrencyPopup()">Cancel</button>
                </form>
            </div>
        </div>
        <div id="modifyCurrencyPopup" class="popup">
            <div class="popup-content">
                <form action="currencymaster.php" method="post">
                    <label for="modifyCurrencyID">Currency ID</label>
                    <input type="text" id="modifyCurrencyID" name="modifyCurrencyID"> <br>

                    <label for="modifyCountryName">Country Name</label>
                    <input type="text" id="modifyCountryName" name="modifyCountryName"> <br>

                    <label for="modifyCurrencyOfCountry">Currency of Country</label>
                    <input type="text" id="modifyCurrencyOfCountry" name="modifyCurrencyOfCountry"> <br>

                    <button type="submit" name="modify" value="modify">Update</button>
                    <button type="button" onclick="closeModifyCurrencyPopup()">Cancel</button>
                </form>
            </div>
        </div>

        
    `;
            document.getElementById('output').innerHTML = currency;
        }

        function highlightCurrencyRow(currencyId) {
            var rows = document.querySelectorAll("#currencyTable tr");
            for (var i = 0; i < rows.length; i++) {
                rows[i].classList.remove("selected");
            }

            var selectedRow = document.querySelector("tr[data-currencyid='" + currencyId + "']");
            if (selectedRow) {
                selectedRow.classList.add("selected");
            }
        }

        function showInsertCurrencyPopup() {
            document.getElementById('insertCurrencyPopup').style.display = 'block';
        }

        function closeInsertCurrencyPopup() {
            document.getElementById('insertCurrencyPopup').style.display = 'none';
        }

        function showModifyCurrencyPopup() {
            var selectedRow = document.querySelector("#currency .commontable table tr.selected");
            if (selectedRow) {
                var currencyId = selectedRow.getAttribute('data-currencyid');
                var countryName = selectedRow.cells[1].innerText;
                var currencyOfCountry = selectedRow.cells[2].innerText;

                document.getElementById('modifyCurrencyID').value = currencyId;
                document.getElementById('modifyCountryName').value = countryName;
                document.getElementById('modifyCurrencyOfCountry').value = currencyOfCountry;

                document.getElementById('modifyCurrencyPopup').style.display = 'block';
            } else {
                alert('Please select a currency to modify.');
            }
        }

        function closeModifyCurrencyPopup() {
            document.getElementById('modifyCurrencyPopup').style.display = 'none';
        }

        function deleteCurrency() {
            var selectedRow = document.querySelector("#currency .commontable table tr.selected");

            if (selectedRow) {
                var currencyId = selectedRow.getAttribute('data-currencyid');

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            selectedRow.remove();
                        } else {
                            alert("Failed to delete the row. Please try again.");
                        }
                    }
                };

                xhttp.open("POST", "currencydelete.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("currencyID=" + encodeURIComponent(currencyId));
            } else {
                alert("Please select a row to delete.");
            }
        }

        function viewCurrency() {
            var selectedRow = document.querySelector("#currency .commontable table tr.selected");

            if (selectedRow) {
                var currencyId = selectedRow.getAttribute('data-currencyid');
                var countryName = selectedRow.cells[1].textContent;
                var currencyOfCountry = selectedRow.cells[2].textContent;

                var details = "Currency ID: " + currencyId + "\nCountry Name: " + countryName + "\nCurrency of Country: " + currencyOfCountry;
                alert(details);
            } else {
                alert("Please select a row to view details.");
            }
        }

        function closeCurrency() {
            window.location.href = '';
        }















        function companymaster() {
            const company = `
        <div id="company">
            <h2><b>Company List</b></h2>
            <div class="commontable">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "menu";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT CompanyID, CompanyCode, CompanyName, City FROM companymaster";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table id='companyTable'> <!-- Add id to the table -->
                     <tr>
                        <th>Company ID</th>
                        <th>Company Code</th>
                        <th>Company Name</th>
                        <th>City</th> 
                    </tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr data-companyid='{$row['CompanyID']}' data-companycode='{$row['CompanyCode']}' data-companyname='{$row['CompanyName']}' data-city='{$row['City']}' onclick='highlightCompanyRow(\"{$row['CompanyID']}\")'>
                        <td>{$row['CompanyID']}</td>
                        <td>{$row['CompanyCode']}</td>
                        <td>{$row['CompanyName']}</td>
                        <td>{$row['City']}</td> 
                    </tr>";
                    }

                    echo "</table>";
                } else {
                    echo "No records found";
                }

                $conn->close();
                ?>           

            <div class="button-container">
                <button onclick="showInsertCompanyPopup()">Insert</button>
                <button onclick="showModifyCompanyPopup()">Modify</button>
                <button onclick="deleteCompany()">Delete</button>
                <button onclick="viewCompany()">View</button>
                <button onclick="closeCompany()">Close</button>
            </div>
         </div> 
        </div>   
        
        <div id="insertCompanyPopup" class="popup">
    <div class="popup-content">
        <form action="companymaster.php" method="post">
            <label for="companyID">Company ID</label>
            <input type="text" id="companyID" name="companyID"> <br>

            <label for="companyCode">Company Code</label>
            <input type="text" id="companyCode" name="companyCode"> <br>

            <label for="companyName">Company Name</label>
            <input type="text" id="companyName" name="companyName"> <br>

            <label for="city">City</label>
            <input type="text" id="city" name="city"> <br>

            <button type="submit" name="submit">Submit</button>
            <button type="button" onclick="closeInsertCompanyPopup()">Cancel</button>
        </form>
    </div>
</div>

<div id="modifyCompanyPopup" class="popup">
    <div class="popup-content">
        <form action="companymaster.php" method="post">
            <label for="modifyCompanyID">Company ID</label>
            <input type="text" id="modifyCompanyID" name="modifyCompanyID"> <br>

            <label for="modifyCompanyCode">Company Code</label>
            <input type="text" id="modifyCompanyCode" name="modifyCompanyCode"> <br>

            <label for="modifyCompanyName">Company Name</label>
            <input type="text" id="modifyCompanyName" name="modifyCompanyName"> <br>

            <label for="modifyCity">City</label>
            <input type="text" id="modifyCity" name="modifyCity"> <br>

            <button type="submit" name="modify" value="modify">Update</button>
            <button type="button" onclick="closeModifyCompanyPopup()">Cancel</button>
        </form>
    </div>
</div>

    `;
            document.getElementById('output').innerHTML = company;

        }


        function highlightCompanyRow(companyId) {
            var rows = document.querySelectorAll("#companyTable tr");
            for (var i = 0; i < rows.length; i++) {
                rows[i].classList.remove("selected");
            }

            var selectedRow = document.querySelector("tr[data-companyid='" + companyId + "']");
            if (selectedRow) {
                selectedRow.classList.add("selected");
            }
        }

        function showInsertCompanyPopup() {
            document.getElementById('insertCompanyPopup').style.display = 'block';
        }

        function closeInsertCompanyPopup() {
            document.getElementById('insertCompanyPopup').style.display = 'none';
        }

        function showModifyCompanyPopup() {
            var selectedRow = document.querySelector("#companyTable tr.selected");
            if (selectedRow) {
                var companyId = selectedRow.getAttribute('data-companyid');
                var companyName = selectedRow.cells[2].innerText; 
                var companyCode = selectedRow.cells[1].innerText; 
                var city = selectedRow.cells[3].innerText;

                document.getElementById('modifyCompanyID').value = companyId;
                document.getElementById('modifyCompanyName').value = companyName;
                document.getElementById('modifyCompanyCode').value = companyCode;
                document.getElementById('modifyCity').value = city;

                document.getElementById('modifyCompanyPopup').style.display = 'block';
            } else {
                alert('Please select a company to modify.');
            }
        }


        function closeModifyCompanyPopup() {
            document.getElementById('modifyCompanyPopup').style.display = 'none';
        }

        function deleteCompany() {
            var selectedRow = document.querySelector("#companyTable tr.selected");
            if (selectedRow) {
                var companyId = selectedRow.getAttribute('data-companyid');

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            selectedRow.remove();
                        } else {
                            alert("Failed to delete the row. Please try again.");
                        }
                    }
                };

                xhttp.open("POST", "companydelete.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("companyID=" + encodeURIComponent(companyId));
            } else {
                alert("Please select a row to delete.");
            }
        }


        function viewCompany() {
            var selectedRow = document.querySelector("#companyTable tr.selected");

            if (selectedRow) {
                var companyId = selectedRow.getAttribute('data-companyid');
                var companyName = selectedRow.cells[2].textContent;
                var city = selectedRow.cells[3].textContent;

                var details = "Company ID: " + companyId + "\nCompany Name: " + companyName + "\nCity: " + city;
                alert(details);
            } else {
                alert("Please select a row to view details.");
            }
        }

        function closeCompany() {
            window.location.href = '';
        }






        function countrymaster() {
            const country = `
        <div id="country">
            <h2><b>Country List</b></h2>
            <div class = commontable>
            <table>
                <tr>
                    <th>Country Code</th>
                    <th>Name of Country</th>
                </tr>
                
            </table>
            <div class="button-container">
                <button onclick="insert()">Insert</button>
                <button onclick="modify()">Modify</button>
                <button onclick="delete()">Delete</button>
                <button onclick="view()">View</button>
                <button onclick="close()">Close</button>
            </div>
         </div> 
        </div>           
    `;
            document.getElementById('output').innerHTML = country;
        }

        function packagemaster() {

        }

        function CGSTandSGST() {

        }
        // function roomtypemaster() {}
        // function categorymaster() {}
    </script>

</body>

</html>