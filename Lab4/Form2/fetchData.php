<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    body {
        background-color: #121212;
        color: #ffffff;
    }
    .bg-white {
        background-color: #1e1e1e;
    }
    .text-black {
        color: #ffffff;
    }
</style>
</head>
<body class="bg-gray-900 flex flex-col items-center justify-center min-h-screen">

<h1 class="text-3xl font-semibold italic mb-8 text-white">Fetch Data from Database using AJAX</h1>

<button class="btn btn-primary bg-blue-700 text-white px-4 py-2 rounded mb-8" id="showData">Show User Data</button>

<div id="table-container" class="w-full max-w-4xl bg-white shadow-md rounded p-4 mx-auto"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="ajax-script.js"></script>

<script type="text/javascript">
$(document).on('click','#showData',function(e){
        $.ajax({    
            type: "GET",
            url: "sendData.php",             
            dataType: "html",                  
            success: function(data){                    
                $("#table-container").html(data); 
            }
        });
});
</script>
</body>
</html>
