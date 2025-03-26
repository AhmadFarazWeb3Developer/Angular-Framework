<!DOCTYPE html>
<html lang="en" ng-app="myApp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Dynamic Cards</title>
</head>

<body ng-controller="MainCtrl" ng-class="selectedTheme">
    <header>
        <nav>
            <ul>
                <li>Home</li>
                <li>Services</li>
                <li>About</li>
                <li>Contact Us</li>
                <li>Why Us?</li>
            </ul>
        </nav>
        <button ng-click="toggleTheme('classic')">Classic Theme</button>
        <button ng-click="toggleTheme('neon')">Neon Theme</button>
        <button ng-click="toggleTheme('modern')">Modern Theme</button>
    </header>
    
    <div class="cards">
        <div class="card fade" ng-repeat="card in cards" ng-class="selectedTheme">
            <h6>{{ card.title }}</h6>
            <p ng-show="card.showContent">{{ card.content }}</p>
            <button ng-click="card.showContent = !card.showContent">Toggle Description</button>
        </div>
    </div>
    
    <script>
        var app = angular.module("myApp", []);
        
        app.controller("MainCtrl", function ($scope) {
            $scope.selectedTheme = 'classic';
            $scope.cards = [
                { title: "Card 1", content: "This is the first card", showContent: false },
                { title: "Card 2", content: "This is the second card", showContent: false },
                { title: "Card 3", content: "Another interesting card", showContent: false },
                { title: "Card 4", content: "Details about this card", showContent: false }
            ];
            
            $scope.toggleTheme = function (theme) {
                $scope.selectedTheme = theme;
            };
        });
    </script>

    <style>
        body.classic {
            background-color: #f5f5f5;
            color: black;
            font-family: "Times New Roman", serif;
        }
        
        body.neon {
            background-color: black;
            color: #00ffcc;
            font-family: "Arial", sans-serif;
        }
        
        body.modern {
            background-color: #1e1e1e;
            color: white;
            font-family: "Roboto", sans-serif;
        }

        .card.classic {
            background-color: white;
            border: 1px solid #ccc;
            color: black;
        }
        
        .card.neon {
            background-color: #222;
            border: 2px solid #00ffcc;
            box-shadow: 0px 0px 10px #00ffcc;
            color: #00ffcc;
        }
        
        .card.modern {
            background-color: #333;
            border: none;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.1);
        }
    </style>
</body>
</html>
