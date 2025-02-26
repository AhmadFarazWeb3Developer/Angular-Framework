<!DOCTYPE html>
<html ng-app="myApp">

<head>
    <meta charset="UTF-8">
    <title>AngularJS Planets Rotation</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: black;
            color: white;
        }

        .planet-container {
            text-align: center;
            margin: 20px;
        }

        .planet {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: inline-block;
            transition: transform 0.5s;
        }

        .planet:hover {
            transform: rotate(360deg);
        }
    </style>
</head>

<body ng-controller="MainController" class="container mt-4">

    <body ng-controller="MainController" class="planet-container mt-4">
        <h2>Hover Over a Planet</h2>
        <div class="row">
            <div class="col-md-3 planet-container" ng-repeat="planet in planets">
                <img ng-src="{{ planet.image }}" class="planet" alt="{{ planet.name }}">
                <p><strong>{{ planet.name }}</strong></p>
                <p>{{ planet.description }}</p>
            </div>
        </div>

        <script>
            angular.module('myApp', []).controller('MainController', function ($scope) {
                $scope.planets = [
                    { name: 'Mercury', description: 'Smallest planet in our solar system.', image: 'mercury.png' },
                    { name: 'Venus', description: 'Hottest planet with thick clouds.', image: 'venus.png' },
                    { name: 'Earth', description: 'Our home planet.', image: 'earth.png' },
                    { name: 'Mars', description: 'The Red Planet.', image: 'mars.png' },
                    { name: 'Jupiter', description: 'Largest planet with a big red spot.', image: 'jupitar.png' },
                    { name: 'Saturn', description: 'Famous for its rings.', image: 'saturn.png' },
                    { name: 'Uranus', description: 'Rotates on its side.', image: 'urnus.png' },
                    { name: 'Neptune', description: 'Farthest planet from the sun.', image: 'naptune.png' }
                ];
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    </body>

</html>