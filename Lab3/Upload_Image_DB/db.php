<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab3";

$connection = mysqli_connect(
    $servername,
    $username,
    $password,
    $dbname
);

if (!$connection) {
    die("Connection Failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $image = $_FILES["image"]["tmp_name"];


    if ($image) {
        $imageContent = addslashes(file_get_contents($image));

        $query = "INSERT INTO upload_image (image) VALUES ('$imageContent')";

        if (mysqli_query($connection, $query)) {
        } else {
            echo "Database insertion failed";
        }
    }
}
$query = "SELECT* FROM upload_image";
$result = mysqli_query($connection, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<img src=data:image/jpeg;base64," . base64_encode($row['image']) . ">";
    }
} else {
    echo "No Image Found";
}

mysqli_close($connection);
