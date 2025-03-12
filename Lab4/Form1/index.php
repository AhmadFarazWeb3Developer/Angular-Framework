<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body  class="bg-gray-900 text-gray-200">

<div class="max-w-lg mx-auto mt-12 p-6 bg-gray-800 rounded-lg shadow-lg">
    <form id="fupForm" class="space-y-6">
        <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" id="email" ng-model="formData.email" class="mt-1 block w-full px-3 py-2 border border-gray-700 rounded-md shadow-sm bg-gray-700 text-gray-200 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="age" class="block text-sm font-medium">Age</label>
            <input type="number" id="age" ng-model="formData.age" class="mt-1 block w-full px-3 py-2 border border-gray-700 rounded-md shadow-sm bg-gray-700 text-gray-200 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium">Gender</label>
            <div class="mt-2 space-y-2">
                <div class="flex items-center">
                    <input id="male" name="gender" type="radio" ng-model="formData.gender" value="male" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-700 bg-gray-700">
                    <label for="male" class="ml-3 block text-sm font-medium">Male</label>
                </div>
                <div class="flex items-center">
                    <input id="female" name="gender" type="radio" ng-model="formData.gender" value="female" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-700 bg-gray-700">
                    <label for="female" class="ml-3 block text-sm font-medium">Female</label>
                </div>
            </div>
        </div>

        <div>
            <label for="country" class="block text-sm font-medium">Country</label>
            <select id="country" ng-model="formData.country" class="mt-1 block w-full px-3 py-2 border border-gray-700 bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="USA">USA</option>
                <option value="Canada">Canada</option>
                <option value="UK">UK</option>
                <option value="Australia">Australia</option>
            </select>
        </div>

        <div>
            <label for="city" class="block text-sm font-medium">City</label>
            <select id="city" ng-model="formData.city" class="mt-1 block w-full px-3 py-2 border border-gray-700 bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="New York">New York</option>
                <option value="Toronto">Toronto</option>
                <option value="London">London</option>
                <option value="Sydney">Sydney</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Choose your Favorite Area</label>
            <div class="mt-2 space-y-2">
                <div class="flex items-center">
                    <input id="frontend" name="favoriteArea" type="radio" ng-model="formData.favoriteArea" value="frontend" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-700 bg-gray-700">
                    <label for="frontend" class="ml-3 block text-sm font-medium">Frontend</label>
                </div>
                <div class="flex items-center">
                    <input id="backend" name="favoriteArea" type="radio" ng-model="formData.favoriteArea" value="backend" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-700 bg-gray-700">
                    <label for="backend" class="ml-3 block text-sm font-medium">Backend</label>
                </div>
                <div class="flex items-center">
                    <input id="fullstack" name="favoriteArea" type="radio" ng-model="formData.favoriteArea" value="fullstack" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-700 bg-gray-700">
                    <label for="fullstack" class="ml-3 block text-sm font-medium">Fullstack</label>
                </div>
            </div>
        </div>

        <div>
            <button type="button" id="butsave" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
        </div>
    </form>
</div>

<script>
   $(document).ready(function() {
    $('#butsave').on('click', function() {
        $("#butsave").attr("disabled", "disabled");
        var email = $('#email').val();
        var age = $('#age').val();
        var gender = $('input[name="gender"]:checked').val();
        var country = $('#country').val();
        var city = $('#city').val();
        var favoriteArea = $('input[name="favoriteArea"]:checked').val();
        if(email!="" && age!="" && gender!="" && country!="" && city!="" && favoriteArea!=""){
            $.ajax({
                url: "insert_db.php",
                type: "POST",
                data: {
                    email: email,
                    age: age,
                    gender: gender,
                    country: country,
                    city: city,
                    favoriteArea: favoriteArea
                },
                cache: false,
                success: function(dataResult){
                    console.log(dataResult)
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $("#butsave").removeAttr("disabled");
                        $('#fupForm').find('input:text, input:radio, select').val('');
                        $("#success").show();
                        $('#success').html('Data added successfully !'); 						
                    }
                    else if(dataResult.statusCode==201){
                        alert("Error occurred !");
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
