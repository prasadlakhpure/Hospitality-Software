<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Booking and Reservation System">
    <title>Booking and Reservation System</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            overflow-x: auto;
        }

        #container {
            margin: 20px auto;
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

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
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
            background-color: #FFD700;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 10px 0;
            text-align: center;
            z-index: 1000;
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
                        <th>Check-In Date</th>
                        <th>Guest Title</th>
                        <th>Guest Name</th>                    
                        <th>Company Name</th>
                        <th>Room Number</th>
                        <th>Room Type</th>
                        <th>Check-Out Date</th>
                        <th>Advance</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['checkInDate']}</td>
                        <td>{$row['guestTitle']}</td>
                        <td>{$row['guestName']}</td>                    
                        <td>{$row['companyName']}</td>
                        <td>{$row['roomNumber']}</td>
                        <td>{$row['roomType']}</td>                  
                        <td>{$row['checkOutDate']}</td>
                        <td>{$row['advance']}</td>
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
        <input type="date" id="datePicker" onchange="viewRecordsByDate()">
        <button onclick="showAllArrivals()">All Arrivals</button>
        <button onclick="showTodaysArrivals()">Today's Arrivals</button>
        <button onclick="addFunction()">Add</button>
        <button onclick="updateFunction()">Update/Modify</button>
        <button onclick="deleteSelectedRow()">Delete</button> <!-- Changed the onclick function -->
        <button onclick="showFunction()">Show</button>
        <button onclick="closeFunction()">Close</button>
    </div>

    <script>
        // JavaScript functions for row selection and deletion
        function showAllArrivals() {
            // Code to show all arrivals
        }

        function showTodaysArrivals() {
            // Code to show today's arrivals
        }

        function viewRecordsByDate() {
            var selectedDate = document.getElementById("datePicker").value;
            // Code to fetch and display records for the selected date
        }

        function addFunction() {
            window.location.href = 'booking.html';
        }

        function updateFunction() {
            // Update/Modify functionality code goes here
        }

        function deleteSelectedRow() {
            var table = document.querySelector("table");
            var selectedRow = table.querySelector(".selected");

            if (selectedRow) {
                var rowId = selectedRow.cells[0].innerText; // Assuming the ID is in the first column

                // Send an AJAX request to delete the row with the ID
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            // Row deleted successfully, you may want to update the UI accordingly
                            selectedRow.remove();
                        } else {
                            // Handle error or provide feedback
                            alert("Failed to delete the row. Please try again.");
                        }
                    }
                };
                xhttp.open("POST", "delete.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id=" + rowId);
            } else {
                alert("Please select a row to delete.");
            }
        }


        function showFunction() {
            // Show functionality code goes here
        }

        function closeFunction() {
            // Close functionality code goes here
        }

        // Function to handle row selection
        document.addEventListener("DOMContentLoaded", function() {
            var table = document.querySelector("table");
            table.addEventListener("click", function(event) {
                var target = event.target;
                while (target && target !== table) {
                    if (target.tagName === "TR") {
                        if (target.classList.contains("selected")) {
                            target.classList.remove("selected");
                        } else {
                            target.classList.add("selected");
                        }
                        return;
                    }
                    target = target.parentNode;
                }
            });
        });
    </script>
</body>

</html>