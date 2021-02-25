<?php
session_start();
include 'src/Auth/IsAuth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="src/Asset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/Asset/css/Style.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <title>Home | Lecturer Evaluation</title>
</head>

<body>
    <div class="AppHome">
        <div class="AppHeader">
            <div class="container">
                <div class="d-flex w-full justify-content-between align-items-center">
                    <div class="logo">
                        <img src="src/Asset/images/appLogo.png" alt="">
                    </div>
                    <a href="/login" class="d-flex justify-content-center align-items-center loginButton">
                        <span class="log-in-outline"></span>
                        <span>Login</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="showcase d-flex justify-content-center align-items-center flex-column">
            <h2>Welcome to LE</h2>
            <h5>Lecturer Evaluation</h5>
            <div class="university">
                <img src="src/Asset/images/logo.png" alt="">
            </div>
        </div>
    </div>
</body>

</html>