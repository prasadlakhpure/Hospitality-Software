<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-Out</title>
    <link rel="stylesheet" href="./style11.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            margin-top: 20px;
        }

        #container {
            padding: 20px;
            max-width: 1200px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
        }

        #container table {
            width: 100%;
            border-collapse: collapse;
        }

        #container th, #container td {
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
            text-align: center;
        }

        .navbar button {
            margin: 0 10px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            background-color: #555555;
            color: #ffffff;
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
    </style>
</head>
<body>
    <div id="sidebar"></div>
    <div class="main-content">
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
                    echo "<tr>
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
            <button onclick="">Button 1</button>
            <button onclick="">Button 2</button>
            <button onclick="">Button 3</button>
            <button onclick="">Button 4</button>
            <button onclick="">Button 5</button>
            <button onclick="">Button 6</button>
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
    </script>

</body>
</html>
