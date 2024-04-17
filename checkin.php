<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation System</title>
    <style>
        #container {
            margin: 0 auto;
            padding: 20px;
            max-width: 1200px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:hover {
            background-color: #ecf0f1;
        }

        .navbar {
            background-color: #2980b9;
            text-align: center;
            padding: 10px 0;
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

        .selected {
            background-color: #3498db !important;
            color: #fff;
        }
    </style>
</head>

<body>
    <div id="sidebar"></div>
    <div id="container">
        <div class="navbar">
            <button onclick="expectedArrival()"><b>Expected Arrival</b></button>
            <button onclick="reservedRegistration()"><b>Reserved Registration</b></button>
            <button onclick="expectedDeparture()"><b>Expected Departure</b></button>
            <button onclick="checkIn()"><b>Check-In</b></button>
        </div>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "menu";

        // Database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, guestTitle, guestName, companyName, checkInDate, checkOutDate, roomType, roomNumber FROM booking";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr>
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
                echo "<tr data-id='{$row['id']}'>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var buttons = document.querySelectorAll('.navbar button');
            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    buttons.forEach(btn => btn.classList.remove('selected'));
                    this.classList.add('selected');
                });
            });
        });

        function filterRows(columnIndex, condition) {
            var rows = document.querySelectorAll("table tr:not(:first-child)");
            rows.forEach(function(row) {
                var date = new Date(row.cells[columnIndex].textContent);
                row.style.display = condition(date) ? "" : "none";
            });
        }

        function expectedArrival() {
            filterRows(5, date => date.toISOString().split('T')[0] === new Date().toISOString().split('T')[0]);
        }

        function reservedRegistration() {
            filterRows(5, date => date.toISOString().split('T')[0] > new Date().toISOString().split('T')[0]);
        }

        function expectedDeparture() {
            filterRows(6, date => date.toISOString().split('T')[0] >= new Date().toISOString().split('T')[0]);
        }

        function checkIn() {
            var rows = document.querySelectorAll("table tr:not(:first-child)");
            var found = Array.from(rows).some(row => {
                if (new Date(row.cells[5].textContent).toISOString().split('T')[0] === new Date().toISOString().split('T')[0]) {
                    redirectToCheckPage(row);
                    return true;
                }
            });

            if (!found) {
                alert("No check-ins for today found.");
            }
        }

        function redirectToCheckPage(row) {
            const id = row.getAttribute('data-id');
            window.location.href = `check.php?id=${id}`;
        }

        function includeContent(url, targetId) {
            fetch(url).then(response => response.text())
            .then(html => {
                document.getElementById(targetId).innerHTML = html;
            }).catch(error => {
                console.error('Error loading the sidebar:', error);
            });
        }

        includeContent('menu.html', 'sidebar');
    </script>
</body>

</html>
