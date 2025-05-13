<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
  <meta charset="UTF-8">
  <title>Mobile Info</title>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body ng-controller="MainController">
<p>Ahmad Faraz(215154)</p>
  <h1>Ask Anything About Mobiles</h1>
  <input ng-model="selectedImage" placeholder="Enter Image Name (no extension)">

  <div ng-repeat="item in images">
    <img ng-if="selectedImage === item.name" 
         ng-src="{{ baseUrl + item.name + ext }}" 
         alt="{{ item.description }}" width="200">
    <p ng-if="selectedImage === item.name">{{ item.description }}</p>
  </div>

  <script>
    angular.module('myApp', []).controller('MainController', function($scope) {
      $scope.baseUrl = 'http://localhost/images/';
      $scope.ext = '.jpg'; 

      $scope.images = [
        { name: 'samsung', description: 'Samsung Galaxy S21 Ultra' },
        { name: 'oppo', description: 'Oppo Reno 6 Pro' },
        { name: 'vivo', description: 'Vivo V25 5G' },
        { name: 'iphone', description: 'Apple iPhone 13 Pro Max' },
        { name: 'realme', description: 'Realme GT Neo 3' },
        { name: 'infinix', description: 'Infinix Zero Ultra' },
        { name: 'tecno', description: 'Tecno Phantom X2' },
        { name: 'nokia', description: 'Nokia G21' },
        { name: 'xiaomi', description: 'Xiaomi 12 Pro' },
        { name: 'oneplus', description: 'OnePlus 10T' }
      ];
    });
  </script>

</body>
</html>
