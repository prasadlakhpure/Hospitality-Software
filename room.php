<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Reservation</title>
    <link rel="stylesheet" href="style11.css">
</head>

<body>
    <div id="sidebar"></div>
    <div class="content" id="room">
        <form action="room.php" method="post">
            <h2><i>Room Reservation</i></h2>
            <div class="roomwrapper">
                <div class="roombx">

                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "menu";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT guestTitle, guestName,roomNumber, roomType, checkInDate, checkOutDate,  companyName, discount FROM booking";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table>
                    <tr>                    
                    <th>Guest Title</th>
                    <th>Guest Name</th>
                    <th>Room Number</th>                  
                    <th>Room Type</th>                    
                    <th>Check-In Date</th>
                    <th>Check-Out Date</th>                  
                    <th>Company Name</th>
                    <th>Discount</th>                    
                    </tr>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>                    
                    <td>{$row['guestTitle']}</td>
                    <td>{$row['guestName']}</td>
                    <td>{$row['roomNumber']}</td>
                    <td>{$row['roomType']}</td>                  
                    <td>{$row['checkInDate']}</td>
                    <td>{$row['checkOutDate']}</td>
                    <td>{$row['companyName']}</td>
                    <td>{$row['discount']}</td>
                    </tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "No records found";
                    }

                    $conn->close();
                    ?>

                    <nav class="navbar">
                        <button onclick="addFunction()">Add</button>
                        <button onclick="updateFunction()">Update/Modify</button>
                        <button onclick="deleteFunction()">Delete</button>
                        <button onclick="showFunction()">Show</button>
                        <button onclick="closeFunction()">Close</button>
                    </nav>
                </div>
            </div>
        </form>
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

        function addFunction() {
            // Add functionality code goes here
        }

        function updateFunction() {
            // Update/Modify functionality code goes here
        }

        function deleteFunction() {
            // Delete functionality code goes here
        }

        function showFunction() {
            // Show functionality code goes here
        }

        function closeFunction() {
            // Close functionality code goes here
        }
    </script>
</body>

</html>