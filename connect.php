<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['Username'];
    $pass = $_POST['Password'];

    // Example SQL query, replace with your actual table and column names
    $sql = "SELECT * FROM login WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Authentication successful
        // Redirect or perform other actions here
        echo "Login successful";
    } else {
        // Authentication failed
        echo "Invalid username or password";
    }
}

// Close the connection
$conn->close();

?>
