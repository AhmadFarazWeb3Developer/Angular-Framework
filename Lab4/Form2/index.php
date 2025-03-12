<html>
<head>
    <title>Insert data in MySQL database using Ajax</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body class="bg-gray-900 text-white">
<div class="max-w-lg mx-auto mt-10 bg-gray-800 p-6 rounded-lg shadow-lg">
    <form id="fupForm">
        <div class="mb-4">
            <label class="block text-white text-sm font-bold mb-2" for="name">Name</label>
            <input type="text" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-white text-sm font-bold mb-2" for="email">Email</label>
            <input type="text" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-white text-sm font-bold mb-2" for="phone">Phone</label>
            <input type="text" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label class="block text-white text-sm font-bold mb-2" for="city">City</label>
            <input type="text" id="city" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-between">
            <input type="button" name="save" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" value="Save to database" id="butsave"> 
        </div>
    </form>
    <div id="success" class="mt-4 text-green-500 hidden"></div>
</div>

<script>
$(document).ready(function() {
    $('#butsave').on('click', function() {
        $("#butsave").attr("disabled", "disabled");
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var city = $('#city').val();
        if(name!="" && email!="" && phone!="" && city!=""){
            $.ajax({
                url: "save2.php",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    phone: phone,
                    city: city				
                },
                cache: false,
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $("#butsave").removeAttr("disabled");
                        $('#fupForm').find('input:text').val('');
                        $("#success").show();
                        $('#success').html('Data added successfully !'); 						
                    }
                    else if(dataResult.statusCode==201){
                        alert("Error occured !");
                    }
                }
            });
        }
        else{
            alert('Please fill all the fields !');
        }
    });
});
</script>

</body>
</html>
