<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-Out</title>
    <link rel="stylesheet" href="./style11.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #container {
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            margin: 20px auto;
        }

        #container table {
            width: 100%;
            border-collapse: collapse;
        }

        #container th,
        #container td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        #container th {
            background-color: #4CAF50;
            color: #ffffff;
        }

        #container tr:hover {
            background-color: #f1f1f1;
        }

        .navbar {
            background-color: #333333;
            width: 95%;
            padding: 10px 0;
            text-align: right;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        .navbar span {
            margin-right: 20px;
            color: #ffffff;
            margin-bottom: 10px;
        }

        .navbar .line1,
        .navbar .line2 {
            display: flex;
            align-items: center;
        }

        .navbar button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            background-color: #555555;
            color: #ffffff;
            transition: background-color 0.3s ease;
        }

        .navbar button:hover {
            background-color: #777777;
        }

        .navbar input[type="date"] {
            padding: 10px;
            font-size: 16px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .selected {
            background-color: #3498db;
            color: #fff;
        }

        .navbar span,
        .navbar button,
        .navbar input[type="date"] {
            margin-left: 10px;
        }

        /* CSS for Sample Bill */
        #sample-bill-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #sample-bill-table th,
        #sample-bill-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        #sample-bill-table th {
            background-color: #4CAF50;
            color: white;
        }

        #sample-bill-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div id="sidebar"></div>
    <div class="content" id="content-master">
        <div id="container">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "menu";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT id, checkInDate, checkOutDate, guestTitle, guestName, roomNumber, roomType, plan FROM booking";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>Check-In Date</th>
                            <th>Check-Out Date</th>
                            <th>Guest Title</th>
                            <th>Guest Name</th>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Plan</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr id='row{$row['id']}' onclick='selectRow({$row['id']})'>
                            <td>{$row['id']}</td>
                            <td>{$row['checkInDate']}</td>
                            <td>{$row['checkOutDate']}</td>
                            <td>{$row['guestTitle']}</td>
                            <td>{$row['guestName']}</td>
                            <td>{$row['roomNumber']}</td>
                            <td>{$row['roomType']}</td>
                            <td>{$row['plan']}</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "No records found";
            }
            $conn->close();
            ?>
        </div>
        <div class="navbar">
            <div class="line1">
                <span id="todaysroomoccupied">Todays Room Occupied : </span>
                <span id="checkIn">Todays Check-In : </span>
                <span id="exceptedarrivals">Expected Arrivals : </span>
                <span id="Previousdaysoccupany">Previous Days Occupancy : </span>
            </div>
            <div class="line2">
                <span id="totalpax">Todays Pax : </span>
                <span id="checkOut">Todays Check-Out : </span>
                <span id="excepteddeparture">Expected Departure : </span>
                <span id="todaysoutstanding">Todays Outstanding : </span>
            </div>
            <button onclick="prepare()">Prepare</button>
            <button onclick="Samplebill()">Sample Bill</button>
            <button onclick="window.location.href = 'menu.html';">Close</button>
        </div>
    </div>

    <script>
        function includeContent(url, targetId) {
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    document.getElementById(targetId).innerHTML = data;
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                });
        }
        includeContent('menu.html', 'sidebar');

        var selectedRowId = null;

        function selectRow(rowId) {
            if (selectedRowId) {
                document.getElementById('row' + selectedRowId).classList.remove('selected');
            }
            selectedRowId = rowId;
            document.getElementById('row' + rowId).classList.add('selected');
        }

        function Samplebill() {
            if (selectedRowId) {
                var selectedRow = document.getElementById('row' + selectedRowId);
                var id = selectedRow.cells[0].innerHTML;
                var checkInDate = selectedRow.cells[1].innerHTML;
                var checkOutDate = selectedRow.cells[2].innerHTML;
                var guestTitle = selectedRow.cells[3].innerHTML;
                var guestName = selectedRow.cells[4].innerHTML;
                var roomNumber = selectedRow.cells[5].innerHTML;
                var roomType = selectedRow.cells[6].innerHTML;
                var plan = selectedRow.cells[7].innerHTML;

                // Creating a table for the sample bill
                var sampleBillTable = `
                    <table>
                        <tr><th colspan="2">Sample Bill</th></tr>
                        <tr><td>ID:</td><td>${id}</td></tr>
                        <tr><td>Check-In Date:</td><td>${checkInDate}</td></tr>
                        <tr><td>Check-Out Date:</td><td>${checkOutDate}</td></tr>
                        <tr><td>Guest Title:</td><td>${guestTitle}</td></tr>
                        <tr><td>Guest Name:</td><td>${guestName}</td></tr>
                        <tr><td>Room Number:</td><td>${roomNumber}</td></tr>
                        <tr><td>Room Type:</td><td>${roomType}</td></tr>
                        <tr><td>Plan:</td><td>${plan}</td></tr>
                    </table>`;

                // Replace the content of a div with the sample bill table
                document.getElementById('container').innerHTML = sampleBillTable;
            } else {
                alert('Please select a booking to generate a sample bill.');
            }
        }
    </script>


</body>

</html>