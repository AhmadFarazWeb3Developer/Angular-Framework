<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab3";

// Create connection

$connection = mysqli_connect(
    $servername,
    $username,
    $password,
    $dbname
);
// var_dump($connection);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];

    $query = "INSERT INTO users (`name`,`email`)
                    VALUES ('" . $name . "','" . $email . "')";



    $check = mysqli_query($connection, $query);
    // var_dump($chk);
    // echo $chk;
    // die($chk);
    if ($check) {
        echo "Form Submitted";
    } else {
        echo "Form Not Submitted";
    }
}

// Close connection
mysqli_close($connection);
