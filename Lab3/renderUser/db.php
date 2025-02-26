<?php
header('Content-Type: application/json'); // Ensure correct JSON response header

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab3";

// Create a connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connection) {
    die(json_encode(["error" => "Connection failed: " . mysqli_connect_error()]));
}

// Fetch users from the database
$query = "SELECT * FROM users";
$result = mysqli_query($connection, $query);

$users = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    echo json_encode($users);
} else {
    echo json_encode(["error" => "Query failed"]);
}

// Close connection
mysqli_close($connection);
