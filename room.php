<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,z initial-scale=1.0">
    <title>Reservation System</title>
    <link rel="stylesheet" href="style11.css">
    <style>
        #container {
            margin: 0px auto;
            padding: 0px 20px 20px 20px;
            max-width: 1200px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333333;
            color: #fff;
        }

        tr:hover {
            background-color: #ecf0f1;
        }

        .navbar {
            background-color: #2980b9;
            text-align: center;
            width: 100%;
            padding-bottom: 10px;
        }

        .navbar button {
            margin: 0 10px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            background-color: #2c3e50;
            color: #ecf0f1;
            transition: background-color 0.3s;
        }

        .navbar button:hover {
            background-color: #1a252f;
        }

        .navbar input[type="date"] {
            padding: 10px;
            font-size: 16px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .selected {
            background-color: #3498db !important;
            color: #fff;
        }
    </style>
</head>

<body>
    <div id="sidebar"></div>
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

        $sql = "SELECT id, guestTitle, guestName, companyName, checkInDate, checkOutDate, roomType, roomNumber, advance FROM booking";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
            <tr>
                <th>ID</th>
                <th>Room Number</th> 
                <th>Room Type</th>                          
                <th>Guest Title</th>
                <th>Guest Name</th>                
                <th>Check-In Date</th>
                <th>Check-Out Date</th>
                <th>Company Name</th>    
            </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['roomNumber']}</td>
                <td>{$row['roomType']}</td> 
                <td>{$row['guestTitle']}</td>
                <td>{$row['guestName']}</td>                   
                <td>{$row['checkInDate']}</td>               
                <td>{$row['checkOutDate']}</td>
                <td>{$row['companyName']}</td>
              </tr>";
            }

            echo "</table>";
        } else {
            echo "No records found";
        }

        $conn->close();
        ?>
    </div>
    <div class="content" id="content-master">
        <div class="navbar">
            <button onclick="expectedarrival()"><b>Expected Arrival</b></button>
            <button onclick="reservedregistration()"><b>Reserved Registration</b></button>
            <button onclick="expecteddeparture()"><b>Expected Departure</b></button>
            <button onclick="checkIn()"><b>Check-In</b></button>
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


        function expectedarrival() {

            var table = document.querySelector("table");
            var rows = table.querySelectorAll("tr");

            for (var i = 1; i < rows.length; i++) {
                rows[i].style.display = "";
            }
        }


        function reservedregistration() {
            var table = document.querySelector("table");
            var rows = table.querySelectorAll("tr");

            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].querySelectorAll("td");
                var checkInDate = cells[5].textContent;
                var checkOutDate = cells[6].textContent;

                // Check if check-in date is in the future (reserved registration)
                var currentDate = new Date();
                var checkInDateTime = new Date(checkInDate);
                if (checkInDateTime > currentDate) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        function expecteddeparture() {
            var table = document.querySelector("table");
            var rows = table.querySelectorAll("tr");

            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].querySelectorAll("td");
                var checkOutDate = cells[6].textContent;

                // Check if check-out date is in the future (expected departure)
                var currentDate = new Date();
                var checkOutDateTime = new Date(checkOutDate);
                if (checkOutDateTime > currentDate) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        function checkIn() {
            var table = document.querySelector("table");
            var rows = table.querySelectorAll("tr");

            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].querySelectorAll("td");
                var checkInDate = cells[5].textContent;

                // Check if check-in date is today or in the past (already checked-in)
                var currentDate = new Date();
                var checkInDateTime = new Date(checkInDate);
                if (checkInDateTime <= currentDate) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }

            // Redirect to checkin.php after processing
            window.location.href = 'checkin.php';
        }
    </script>

</body>

</html>