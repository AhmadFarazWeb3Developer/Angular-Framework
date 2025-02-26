<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#basic-form").validate();
        });
    </script>
</head>

<body class="bg-gray-800 text-white font-light p-8"></body>
<form id="basic-form" action="db.php" method="post" class="space-y-6">
    <div></div>
    <label for="name" class="block text-lg font-semibold">Name <span class="text-sm">(required, at least 3
            characters)</span></label>
    <input id="name" name="name" minlength="3" type="text" required
        class="mt-2 p-2 w-full border border-gray-300 rounded-md text-black">
    </div>
    <div>
        <label for="email" class="block text-lg font-semibold">E-Mail <span class="text-sm">(required)</span></label>
        <input id="email" type="email" name="email" required class="mt-2 p-2 w-full border border-gray-300 rounded-md text-black">
    </div>
    <div>
        <input class="submit bg-black text-white py-2 px-4 rounded-md cursor-pointer" type="submit" name="submit"
            value="SUBMIT">
    </div>
</form>

<div class="mt-8"></div>
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab3";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from database
$sql = "SELECT id, name, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<p class='mt-2'>Id: " . $row["id"] . "</p>";
        echo "<p class='mt-2'>Name: " . $row["name"] . "</p>";
        echo "<p class='mt-2'>Email: " . $row["email"] . "</p>";
    }
} else {
    echo "<p class='mt-2'>0 results</p>";
}

// Close connection
$conn->close();
?>
</div>
</body>

</html>