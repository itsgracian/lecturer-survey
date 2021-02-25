<?php
session_start();

include 'src/Config/Database.php';

$URI = $_SERVER['REQUEST_URI'];

$success = 'stSuccess';

$error = 'stViewError';

$sql = "SELECT * FROM users WHERE userType='$role[0]' ORDER BY id DESC";

$result = $con->query($sql);

if (!$result) {
    $_SESSION[$error] = 'An error occurred try again';
}
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
    <title>Student</title>
</head>

<body>
    <div class="admin">
        <?php require 'src/Reusable/Header.php'; ?>
        <div class="appContainer">
            <div class="adminDashboard">
                <?php require 'src/Reusable/AdminTab.php'; ?>
                <div class="addLecturer">
                    <a href="/add-student"><button type="button">Add student</button></a>
                </div>
                <?php if (isset($_SESSION[$error])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION[$error]; ?>
                </div>
                <?php endif; ?>
                <div class="course">
                    <?php if ($result->num_rows > 0): ?>
                    <ul>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <li>
                            <div class="name flex-column d-flex justify-content-start lecturerInfo">
                                <span>
                                    <?php echo $row['name']; ?>
                                </span>
                                <small>
                                    <?php echo $row['regNumber']; ?>
                                </small>
                            </div>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>
                    <?php if ($result->num_rows <= 0): ?>
                    <div class="alert alert-secondary" role="alert">
                        No result found
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>