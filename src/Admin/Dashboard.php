<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- CSS only -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="src/Asset/css/Style.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="admin">
        <?php require 'src/Reusable/Header.php'; ?>
        <div class="appContainer">
        <div class="adminDashboard">
            <?php require 'src/Reusable/AdminTab.php'; ?>
            <div class="addLecturer">
            <a href="/add-course"><button type="button">Add course</button></a>
            </div>
            <div class="course">
                <ul>
                    <li>
                        <div class="name">
                            <span>Introduction to Javascript</span>
                        </div>
                        <div class="action d-flex justify-content-center align-items-center">
                           <button type="button" style="color: red;">
                               <span class="ion-ios-trash-outline"></span>
                           </button>
                           <button type="button">
                               <span class="ion-edit"></span>
                           </button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        </div>
    </div>
</body>
</html>