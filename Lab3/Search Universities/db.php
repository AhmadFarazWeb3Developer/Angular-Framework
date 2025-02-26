<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab3";

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
    die(json_encode(["error" => "Connection Failed: " . mysqli_connect_error()]));
}

// Get search query from request
$search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';

if (!$search) {
    echo json_encode(["error" => "You Still Not Searched"]);
    exit;
}

$query = "SELECT * FROM universities WHERE name LIKE '%$search%' ORDER BY rank ASC";

$result = mysqli_query($connection, $query);

$universities = [];

while ($row = mysqli_fetch_assoc($result)) { // Fetches each row as an associative array (column names as keys).
    $universities[] = $row;
}

echo json_encode($universities);

mysqli_close($connection);
