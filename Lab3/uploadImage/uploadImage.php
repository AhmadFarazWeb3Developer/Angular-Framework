<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-white">Upload Image</h2>
        <form id="uploadForm" action="db.php" method="post" enctype="multipart/form-data" class="space-y-6">
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
</body>

</html>