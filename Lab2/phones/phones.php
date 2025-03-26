<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Search</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body ng-app="mobileSearchApp" ng-controller="MainController">

    <h1>📱 Mobile Phone Search</h1>
    <div class="search-bar">
        <input type="text" ng-model="searchQuery" placeholder="Enter exact brand or model" ng-keyup="searchDevices()">
    </div>
    
    <p class="error-message" ng-if="errorMessage">{{ errorMessage }}</p>

    <div class="card-container">
        <div class="card" ng-repeat="device in filteredDevices">
            <h2>{{ device.model_name }}</h2>
            <p><strong>Brand:</strong> {{ device.brand_name }}</p>
            <p><strong>OS:</strong> {{ device.os }}</p>
            <p><strong>Best Price:</strong> ${{ device.best_price }}</p>
            <p><strong>Memory:</strong> {{ device.memory_size }} GB</p>
            <p><strong>Battery:</strong> {{ device.battery_size }} mAh</p>
            <p><strong>Release Date:</strong> {{ device.release_date }}</p>
        </div>
    </div>

    <script>
        var app = angular.module('mobileSearchApp', []);

        app.controller('MainController', function ($scope, $http) {
            $scope.searchQuery = '';
            $scope.devices = [];
            $scope.filteredDevices = [];
            $scope.errorMessage = '';

            // Load CSV from project folder
            $http.get('phones_data.csv').then(function (response) {
                $scope.devices = csvToJson(response.data);
            });

            // Convert CSV to JSON
            function csvToJson(csv) {
                const lines = csv.split("\n");
                const headers = lines[0].split(",");
                const result = [];

                for (let i = 1; i < lines.length; i++) {
                    let obj = {};
                    let currentLine = lines[i].split(",");
                    if (currentLine.length === headers.length) {
                        headers.forEach((header, index) => {
                            obj[header.trim()] = currentLine[index].trim();
                        });
                        result.push(obj);
                    }
                }
                return result;
            }

            // Exact Match Search Function
            $scope.searchDevices = function () {
                if ($scope.searchQuery.trim() === '') {
                    $scope.filteredDevices = [];
                    $scope.errorMessage = '';
                    return;
                }

                const query = $scope.searchQuery.toLowerCase().trim();

                $scope.filteredDevices = $scope.devices.filter(device =>
                    device.model_name.toLowerCase().trim() === query ||
                    device.brand_name.toLowerCase().trim() === query
                );

                $scope.errorMessage = $scope.filteredDevices.length === 0 ? 'No exact match found.' : '';
            };
        });
    </script>

</body>
</html>
