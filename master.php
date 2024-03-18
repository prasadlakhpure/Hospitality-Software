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
                xhttp.send("creditID=" + encodeURIComponent(creditCardID)); // Changed variable name to creditID
            } else {
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
                
                <div class="button-container">
                    <button onclick="showInsertCurrencyPopup()">Insert</button>
                    <button onclick="showModifyCurrencyPopup()">Modify</button>
                    <button onclick="deleteCurrency()">Delete</button>
                    <button onclick="viewCurrency()">View</button>
                    <button onclick="closeCurrency()">Close</button>
                </div>
            </div>
        </div>
    `;
            document.getElementById('output').innerHTML = currency;
        }















        function companymaster() {
            const company = `
        <div id="company">
            <h2><b>Company List</b></h2>
            <div class = commontable>
            <table>
                <tr>
                    <th>Company Name</th>
                    <th>Company Code</th>
                    <th>City</th>                    
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
            document.getElementById('output').innerHTML = company;

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