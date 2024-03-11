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

                $sql = "SELECT RoomCode, RoomDescription FROM roommaster";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table>
                        <tr>
                            <th>Room Code</th>
                            <th>Room Description</th>
                        </tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr data-roomid='{$row['RoomCode']}'>
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
                    <button onclick="modify()">Modify</button>
                    <button onclick="deleteRow()">Delete</button>
                    <button onclick="view()">View</button>
                    <button onclick="close()">Close</button>
                </div>
            </div>
        </div>

        <div id="insertPopup" class="popup">
            <div class="popup-content">
              <form action="roommaster.php" method="post">
                <label for="roomCode">Room Code:</label>
                <input type="text" id="roomCode" name="roomCode"> <br>

                <label for="roomDescription">Room Description:</label>
                <input type="text" id="roomDescription" name="roomDescription"> <br>

                <button onclick="insert()" name="submit" value="submit">Submit</button>
                <button onclick="closeInsertPopup()">Cancel</button>
              </form>
            </div>
        </div>
    `;
            document.getElementById('output').innerHTML = roomDiscriptionMaster;
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

        function modify() {
            // Find the selected row
            const selectedRow = document.querySelector("#roomDiscriptionMaster table tr.selected-row");

            if (selectedRow) {
                // Get the room ID from the selected row
                const roomId = selectedRow.getAttribute("data-roomid");

                // Fetch the room details from the server and pre-fill the form
                fetch(`get_room_details.php?roomId=${roomId}`)
                    .then(response => response.json())
                    .then(roomDetails => {
                        if (roomDetails) {
                            // Populate the form fields with existing data
                            document.getElementById('roomCode').value = roomDetails.RoomCode;
                            document.getElementById('roomDescription').value = roomDetails.RoomDescription;

                            // Show the insert popup for modification
                            showInsertPopup();

                            // Change the submit button behavior to handle modification
                            document.querySelector('#insertPopup button[name="submit"]').onclick = function() {
                                // Update the room details on the server
                                fetch(`modify_room  .php?roomId=${roomId}`, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify({
                                            roomCode: document.getElementById('roomCode').value,
                                            roomDescription: document.getElementById('roomDescription').value,
                                        }),
                                    })
                                    .then(response => response.json())
                                    .then(responseData => {
                                        // Handle the response as needed
                                        console.log(responseData);

                                        // Close the insert popup after modification
                                        closeInsertPopup();
                                    })
                                    .catch(error => {
                                        console.error('Error modifying room:', error);
                                    });
                            };
                        } else {
                            console.error('Error fetching room details.');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching room details:', error);
                    });
            } else {
                alert('Please select a room to modify.');
            }
        }



        function billinstruction() {
            const billInstruction = `
            <div id="billInstruction">
             <h2><b>Bill Instruction List</b></h2>
               <div class = commontable>
                  <table>
                    <tr>
                     <th>Code</th>
                     <th>Description</th>
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
            document.getElementById('output').innerHTML = billInstruction;
        }


        function creditcardmaster() {
            const creditCard = `
        <div id="creditCard">
            <h2><b>Credit Card List</b></h2>
            <div class = commontable>
            <table>
                <tr>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Card Limit</th>
                    <th>Commission</th>
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
            document.getElementById('output').innerHTML = creditCard;
        }


        function currencymaster() {
            const currency = `
        <div id="currency">
            <h2><b>Currency List</b></h2>
            <div class = commontable>
            <table>
                <tr>
                    <th>Country Name</th>
                    <th>Currency of Country</th>
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