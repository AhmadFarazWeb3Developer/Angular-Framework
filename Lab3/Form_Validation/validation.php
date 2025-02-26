<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#basic-form").validate();
        });
    </script>
</head>

<body class="bg-gray-900 text-white font-sans p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Form Section -->
        <form id="basic-form" action="db.php" method="post" class="bg-gray-800 p-8 rounded-lg shadow-lg space-y-6">
            <h2 class="text-2xl font-bold text-center mb-6">User Registration</h2>
            <div>
                <label for="name" class="block text-lg font-semibold mb-2">Name</label>
                <input id="name" name="name" minlength="3" type="text" required
                    class="w-full p-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="email" class="block text-lg font-semibold mb-2">E-Mail</label>
                <input id="email" type="email" name="email" required
                    class="w-full p-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <button type="submit" name="submit"
                    class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-300">SUBMIT</button>
            </div>
        </form>

        <!-- Table Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-center mb-6">Registered Users</h2>
            <div class="overflow-x-auto bg-gray-800 rounded-lg shadow-lg">
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
                    echo "<table class='min-w-full'>";
                    echo "<thead class='bg-gray-700'>";
                    echo "<tr>";
                    echo "<th class='py-3 px-6 text-left'>ID</th>";
                    echo "<th class='py-3 px-6 text-left'>Name</th>";
                    echo "<th class='py-3 px-6 text-left'>Email</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody class='divide-y divide-gray-700'>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='hover:bg-gray-700 transition duration-200'>";
                        echo "<td class='py-4 px-6'>" . $row["id"] . "</td>";
                        echo "<td class='py-4 px-6'>" . $row["name"] . "</td>";
                        echo "<td class='py-4 px-6'>" . $row["email"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<p class='p-6 text-center text-gray-400'>No users found.</p>";
                }

                // Close connection
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>

</html>