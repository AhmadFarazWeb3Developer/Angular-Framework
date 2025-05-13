<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <p>Ahmad Faraz(215154)</p>
    <p>Change the value of the input field:</p>
    <div ng-app="" ng-init="color='yellow'">
        <input ng-style="{'background-color': color}" ng-model="color">
    </div>   
</body>
</html>
