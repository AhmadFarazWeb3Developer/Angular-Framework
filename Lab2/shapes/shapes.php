<!DOCTYPE html>
<html ng-app="shapesApp">

<head>
  <meta charset="UTF-8">
  <title>Draw Shapes with AngularJS</title>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <link rel="stylesheet" href="shapes.css?ver=<?php echo time(); ?>">

</head>

<body ng-controller="ShapesController">
  <h1>Draw a Shape</h1>
  <div class="container">

    <input type="text" ng-model="shapeName" placeholder="Enter shape: circle, square, rectangle, triangle">

    <div class="shape" ng-if="shapeName.toLowerCase() === 'circle'">
      <div class="circle"></div>
    </div>
    <div class="shape" ng-if="shapeName.toLowerCase() === 'square'">
      <div class="square"></div>
    </div>
    <div class="shape" ng-if="shapeName.toLowerCase() === 'rectangle'">
      <div class="rectangle"></div>
    </div>
    <div class="shape" ng-if="shapeName.toLowerCase() === 'triangle'">
      <div class="triangle"></div>
    </div>
  </div>

  <script>
    angular.module('shapesApp', [])
      .controller('ShapesController', ['$scope', function ($scope) {
        $scope.shapeName = "";
      }]);
  </script>
</body>

</html>