<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mousemove Counter</title>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body ng-controller="myCtrl">
<p>Ahmad Faraz(215154)</p>
  <h1 ng-mousemove="incrementCount()">Mouse over me!</h1>
  <h2>{{ count }}</h2>

  <script>
    var app = angular.module('myApp', []);
    app.controller('myCtrl', function($scope) {
      $scope.count = 0;
      $scope.incrementCount = function() {
        $scope.count++;
      };
    });
  </script>

</body>
</html>
