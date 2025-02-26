<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Universities</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body ng-app="universityApp" class="bg-gray-100 text-gray-800">
    <div ng-controller="UniversityController" class="max-w-4xl mx-auto py-10">
        <h2 class="text-3xl font-semibold text-center text-blue-700 mb-6">Best Universities in the World</h2>

        <!-- Search Bar -->
        <div class="flex justify-center mb-6">
            <input type="text" placeholder="Search University" ng-model="searchQuery"
                class="w-3/4 md:w-1/2 px-4 py-2 border-2 border-blue-400 focus:ring-2 focus:ring-blue-500 focus:outline-none rounded-lg shadow-md transition">
        </div>

        <!-- University List -->
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div ng-repeat="university in universities"
                class="bg-white shadow-md rounded-lg overflow-hidden p-4 transform hover:scale-105 transition">
                <img ng-src="{{university.image_url}}" alt="{{university.name}}"
                    class="w-full h-40 object-cover rounded-md">
                <h3 class="text-xl font-bold text-gray-800 mt-3">{{university.name}}</h3>
                <p class="text-gray-600"><strong>Location:</strong> {{university.location}}</p>
                <p class="text-blue-600 font-semibold"><strong>Rank:</strong> #{{university.rank}}</p>
            </div>
        </div>

        <!-- Error Message -->
        <div ng-if="errorMessage" class="text-red-500 text-center mt-6">
            <p>{{ errorMessage }}</p>
        </div>
    </div>

    <script>
        angular.module('universityApp', [])
            .controller('UniversityController', ['$scope', '$http', function ($scope, $http) {
                $scope.searchQuery = '';
                $scope.errorMessage = '';
                let timeout;

                $scope.fetchUniversities = function () {
                    $http.get('db.php?search=' + encodeURIComponent($scope.searchQuery))
                        .then(function (response) {
                            if (response.data.error) {
                                $scope.errorMessage = response.data.error;
                                $scope.universities = [];
                            } else if (response.data.length === 0) {
                                $scope.errorMessage = "No universities found.";
                                $scope.universities = [];
                            } else {
                                $scope.errorMessage = '';
                                $scope.universities = response.data;
                            }
                        })
                        .catch(function (error) {
                            console.error("Error fetching data:", error);
                            $scope.errorMessage = "An error occurred while fetching data.";
                            $scope.universities = [];
                        });
                };

                $scope.$watch('searchQuery', function () {
                    if (timeout) {
                        clearTimeout(timeout);
                    }
                    timeout = setTimeout(function () {
                        $scope.fetchUniversities();
                    }, 500);
                });
            }]);
    </script>
</body>

</html>
