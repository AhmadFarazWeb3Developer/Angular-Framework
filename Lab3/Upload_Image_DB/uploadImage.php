<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 flex items-center justify-center flex-col min-h-screen gap-4">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-white">Upload Image</h2>
        <form id="uploadForm" action="uploadImage.php" method="post" enctype="multipart/form-data" class="space-y-6">
            <div>
                <label for="imageInput" class="block text-sm font-medium text-gray-300">Select Image</label>
                <input type="file" name="image" id="imageInput" accept="image/*"
                    class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-gray-700 text-white">
            </div>
            <div class="flex justify-center">
                <button type="submit" name="submit"
                    class="w-full py-2 bg-orange-500 text-white font-semibold rounded-md shadow-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50">
                    Upload
                </button>
            </div>
        </form>
    </div>

    <div class="bg-gray-800 p-8 rounded-lg shadow-lg mt-8 w-full max-w-4xl">
        <h2 class="text-2xl font-bold mb-6 text-center text-white">Uploaded Images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
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
                        echo "<p class='text-green-500 text-center'>Image uploaded successfully!</p>";
                    } else {
                        echo "<p class='text-red-500 text-center'>Database insertion failed</p>";
                    }
                }
            }

            $query = "SELECT * FROM upload_image";
            $result = mysqli_query($connection, $query);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='bg-gray-700 p-2 rounded-lg shadow-md'>";
                    echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' class='w-full h-auto rounded-md'>";
                    echo "</div>";
                }
            } else {
                echo "<p class='text-white text-center'>No Image Found</p>";
            }

            mysqli_close($connection);
            ?>
        </div>
    </div>
</body>

</html>