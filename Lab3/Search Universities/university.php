<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Universities</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="university.css">
</head>

<body ng-app="universityApp">
    <div ng-controller="UniversityController">
        <h2>Best Universities in the World</h2>
        <input type="text" placeholder="Search University" ng-model="searchQuery">

        <div ng-repeat="university in universities">
            <img src="{{university.image_url}}" alt="{{university.name}}" width="200">
            <h3>{{university.name}}</h3>
            <p><strong>Location:</strong> {{university.location}}</p>
            <p><strong>Rank:</strong> #{{university.rank}}</p>
            <hr>
        </div>
        <div ng-if="errorMessage" id="error-message">
            <p>{{ errorMessage }}</p>
        </div>

    </div>


    <script>
        angular.module('universityApp', [])
            .controller('UniversityController', ['$scope', '$http', function($scope, $http) {
                $scope.searchQuery = '';
                $scope.errorMessage = '';
                let timeout;

                // Function to fetch universities
                $scope.fetchUniversities = function() {
                    $http.get('db.php?search=' + encodeURIComponent($scope.searchQuery))
                        .then(function(response) {
                            // Check if response contains an error
                            if (response.data.error) {
                                $scope.errorMessage = response.data.error;
                                $scope.universities = []; //clear university array
                            } else if (response.data.length === 0) {
                                // Handle case when search is provided but no universities match
                                $scope.errorMessage = "No universities found.";
                                $scope.universities = [];
                            } else {
                                $scope.errorMessage = '';
                                $scope.universities = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.error("Error fetching data:", error);
                            $scope.errorMessage = "An error occurred while fetching data.";
                            $scope.universities = [];
                        });
                };

                // // Fetch all universities on load
                // $scope.fetchUniversities();

                // Debounce search input to avoid too many requests
                $scope.$watch('searchQuery', function() {
                    if (timeout) {
                        clearTimeout(timeout);
                    }
                    timeout = setTimeout(function() {
                        $scope.fetchUniversities();
                    }, 500); // Delay of 500ms
                });


                /*Example Scenario Without Debounce:
The user types "Harvard" quickly.
Without debounce, an API request would be sent 7 times (one for each keystroke).
Example Scenario With Debounce:
The user types "Harvard" quickly.
The debounce logic delays the API request and waits 500ms after the last keystroke.
Only 1 API request is made instead of 7. */
            }]);
    </script>






    <!-- <script>
        angular.module('universityApp', [])
            .controller('UniversityController', ['$scope', '$http', function($scope, $http) {
                $scope.searchQuery = ''; // Initialized as an empty string and updated as the user types.
                let timeout;

                // Function to fetch universities
                $scope.fetchUniversities = function() {
                    $http.get('db.php?search=' + encodeURIComponent($scope.searchQuery))
                        .then(function(response) {
                            $scope.universities = response.data;
                        })
                        .catch(function(error) {
                            console.error("Error fetching data:", error);
                        });
                };

                // Fetch all universities on load
                $scope.fetchUniversities();

                // Debounce search input to avoid too many requests
                $scope.$watch('searchQuery', function() {
                    if (timeout) clearTimeout(timeout);
                    timeout = setTimeout(function() {
                        $scope.fetchUniversities();
                    }, 500); // Delay of 500ms
                });
            }]);
    </script> -->
</body>

</html>