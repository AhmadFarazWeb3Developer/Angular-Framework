<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Chat App</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

    <!-- Socket.IO -->
    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body ng-app="chatApp" ng-controller="chatController"
    class="bg-gray-950 text-gray-200 flex items-center justify-center min-h-screen p-4">

    <!-- Authentication Form -->
    <div class="w-full max-w-md bg-gray-900 text-white rounded-xl shadow-xl p-6 text-center" ng-show="!isAuthenticated">
        <h2 class="text-3xl font-semibold mb-4 text-blue-500">{{ showSignup ? 'Sign Up' : 'Sign In' }}</h2>
        <div class="space-y-4">
            <div ng-show="showSignup" class="relative">
                <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
                <input type="text" placeholder="Full Name" ng-model="auth.name" class="input-box">
            </div>
            <div class="relative">
                <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                <input type="text" placeholder="Username or Email" ng-model="auth.username" class="input-box">
            </div>
            <div class="relative">
                <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                <input type="password" placeholder="Password" ng-model="auth.password" class="input-box">
            </div>
            <button class="btn-primary" ng-click="showSignup ? signup() : login()">
                {{ showSignup ? 'Sign Up' : 'Sign In' }}
            </button>
            <p class="mt-2 text-gray-400 cursor-pointer hover:text-blue-400" ng-click="toggleAuthMode()">
                {{ showSignup ? 'Already have an account? Sign In' : "Don't have an account? Sign Up" }}
            </p>
        </div>
    </div>

    <!-- Chat Interface -->
    <div class="w-full max-w-5xl bg-gray-900 text-white rounded-xl shadow-xl overflow-hidden flex"
        ng-show="isAuthenticated" style="height: 85vh; width: 85vw;">
        <div class="w-1/4 bg-gray-800 p-4">
            <h2 class="text-lg font-semibold mb-4">Users</h2>
            <div class="space-y-3">
                <div class="flex items-center space-x-3" ng-repeat="user in connectedUsers">
                    <div class="avatar">{{ user.charAt(0).toUpperCase() }}</div>
                    <p>{{ user }}</p>
                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-col">
            <div class="bg-gray-800 p-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold">Chat App</h1>
                <p class="text-sm text-gray-400">Connected as: <span class="font-semibold">{{ auth.username }}</span>
                </p>
                <button class="text-red-400 hover:text-red-600 text-lg" ng-click="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>

            <div class="p-4 h-[500px] overflow-y-auto flex-1">
                <div class="space-y-4">
                    <div ng-repeat="message in messages" class="flex"
                        ng-class="{'justify-end': message.sender === auth.username, 'justify-start': message.sender !== auth.username}">
                        <div class="message-box"
                            ng-class="{'bg-blue-600': message.sender === auth.username, 'bg-gray-700': message.sender !== auth.username}">
                            <p><strong>{{ message.sender }}:</strong> {{ message.text }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ message.timestamp }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-800 border-t flex">
                <input type="text" ng-model="newMessage" placeholder="Type a message..." class="input-box flex-1">
                <button class="btn-primary ml-2 flex items-center gap-2" ng-click="sendMessage()">
                    <i class="fas fa-paper-plane"></i> Send
                </button>
            </div>
        </div>
    </div>

    <style>
        .input-box {
            width: 100%;
            padding-left: 2.5rem;
            padding-right: 1rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            background-color: #2d3748;
            border: 1px solid #4a5568;
            border-radius: 0.5rem;
            outline: none;
            color: #fff;
            transition: box-shadow 0.2s;
        }

        .input-box:focus {
            box-shadow: 0 0 0 2px #4299e1;
        }

        .btn-primary {
            width: 100%;
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            background-color: #3182ce;
            color: #fff;
            border-radius: 0.5rem;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #2b6cb0;
        }

        .avatar {
            width: 2.5rem;
            height: 2.5rem;
            background-color: #3182ce;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            font-size: 1.125rem;
            font-weight: 700;
        }

        .message-box {
            padding: 0.75rem;
            border-radius: 0.5rem;
            max-width: 28rem;
            color: #fff;
        }
    </style>

    <script>
        var app = angular.module("chatApp", []);

        app.controller("chatController", function ($scope) {
            $scope.isAuthenticated = false;
            $scope.showSignup = true;
            $scope.auth = { name: "", username: "", password: "" };
            $scope.messages = [];
            $scope.newMessage = "";
            $scope.connectedUsers = [];

            const storedUser = localStorage.getItem("chatUser");
            if (storedUser) {
                const userData = JSON.parse(storedUser);
                $scope.auth.username = userData.username;
                $scope.isAuthenticated = true;
            }

            const socket = io("http://localhost:3000");

            $scope.toggleAuthMode = function () {
                $scope.showSignup = !$scope.showSignup;
            };

            $scope.signup = function () {
                if ($scope.auth.name && $scope.auth.password) {
                    const userData = { username: $scope.auth.name, password: $scope.auth.password };
                    localStorage.setItem("chatUser", JSON.stringify(userData));
                    setTimeout(function () {
                        $scope.showSignup = false;
                        $scope.$apply();
                    }, 2000);
                }
            };

            $scope.login = function () {
                const storedUser = JSON.parse(localStorage.getItem("chatUser"));
                if (storedUser && $scope.auth.username === storedUser.username && $scope.auth.password === storedUser.password) {
                    $scope.isAuthenticated = true;
                    socket.emit("newUser", $scope.auth.username);
                } else {
                    alert("Invalid username or password. Please sign up first.");
                }
            };

            $scope.logout = function () {
                socket.emit("userLeft", $scope.auth.username);
                localStorage.removeItem("chatUser");
                $scope.isAuthenticated = false;
                $scope.connectedUsers = [];
            };
        });
    </script>
</body>

</html>