<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body ng-app="userApp">
    <div ng-controller="userController" class="container mx-auto p-4">
        <table class="min-w-full bg-white border border-gray-200">
            <caption class="text-lg font-semibold mb-4">Registered Users</caption>
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th scope="col" class="py-3 px-6 text-left">ID</th>
                    <th scope="col" class="py-3 px-6 text-left">Name</th>
                    <th scope="col" class="py-3 px-6 text-left">Email</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="user in users" class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{user.id}}</td>
                    <td class="py-3 px-6 text-left">{{user.name}}</td>
                    <td class="py-3 px-6 text-left">{{user.email}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        angular.module('userApp', []).controller('userController', ['$scope', '$http', function($scope, $http) {
            $scope.users = [];

            $scope.fetchUsers = function() {
                $http.get('db.php')
                    .then(function(response) {
                        $scope.users = response.data;
                    })
                    .catch(function(error) {
                        console.error("Error fetching users:", error);
                    });
            };

            $scope.fetchUsers();
        }]);
    </script>

</body>

</html>