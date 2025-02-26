<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Universities</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link rel="stylesheet" href="university.css">
</head>

<body ng-app="universityApp">

    <div ng-controller="UniversityController">
        <h2>Best Universities in the World</h2>

        <input type="text" placeholder="Search University" ng-model="searchQuery">

        <div ng-repeat="university in universities"
            ng-show="university.name.toLowerCase() === searchQuery.toLowerCase()">
            <img src="{{university.image_url}}" alt="{{university.name}}" width="200">
            <h3>{{university.name}}</h3>
            <p><strong>Location:</strong> {{university.location}}</p>
            <p><strong>Rank:</strong> #{{university.rank}}</p>
            <hr>
        </div>
    </div>

    <script>
        angular.module('universityApp', [])
            .controller('UniversityController', ['$scope', function ($scope) {

                $scope.searchQuery = '';

                $scope.universities = [
                    { "name": "Oxford", "location": "Oxford, United Kingdom", "rank": 1, "image_url": "https://educar.ec/wp-content/uploads/2024/02/Universida-de-Oxford-Oxford-University.jpg" },
                    { "name": "Stanford", "location": "Stanford, California, USA", "rank": 2, "image_url": "https://olmsted.org/wp-content/uploads/2023/06/Main-Quad-from-Palm-Dive-by-Linda-Cicero.png" },
                    { "name": "MIT", "location": "Cambridge, Massachusetts, USA", "rank": 3, "image_url": "https://www.ivywise.com/wp-content/uploads/2022/07/MIT-Majors-Editorial-Use-Only-1.jpeg" },
                    { "name": "Harvard", "location": "Cambridge, Massachusetts, USA", "rank": 4, "image_url": "https://cdn.britannica.com/69/141169-050-CD5892EB/Baker-Library-Harvard-Business-School-Boston-University.jpg" },
                    { "name": "California Institute of Technology", "location": "Pasadena, California, USA", "rank": 6, "image_url": "https://caltech-prod.s3.amazonaws.com/main/images/Beckman-Institute_52_Seth_Han.2e16d0ba.fill-534x300-c100.jpg" },
                    { "name": "Princeton", "location": "Princeton, New Jersey, USA", "rank": 7, "image_url": "https://assets.simpleviewinc.com/simpleview/image/upload/c_fill,h_768,q_50,w_1024/v1/clients/princetonnj/princeton_university_main_building_at_front_gate_geraldine_scull_209cbd93-c4fc-4485-a274-66b4076c71e0.jpg" },
                    { "name": "Imperial College London", "location": "London, United Kingdom", "rank": 8, "image_url": "https://www.imperial.ac.uk/ImageCropToolT4/imageTool/uploaded-images/homepage-default-social--tojpeg_1523872141375_x1.jpg" },
                    { "name": "ETH Zurich", "location": "Zurich, Switzerland", "rank": 9, "image_url": "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/ETH_Z%C3%BCrich_im_Abendlicht.jpg/330px-ETH_Z%C3%BCrich_im_Abendlicht.jpg" },
                    { "name": "University of Chicago", "location": "Chicago, Illinois, USA", "rank": 10, "image_url": "https://news.uchicago.edu/sites/default/files/styles/full_width/public/images/2020-03/Campusaerial-1380b.jpg?itok=asWdQleH" }
                ];
            }]);
    </script>

</body>

</html>