<?php
session_start();

include 'src/Auth/IsStudent.php';

include 'src/Config/Database.php';

$error = $_SESSION['fLError'];

$success = $_SESSION['fLSucess'];

$sql = 'SELECT * FROM lecturer ORDER BY createdAt DESC';

$result = $con->query($sql);
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
    <title>Student | Dashboard</title>
</head>

<body>
    <div class="student">
        <?php require 'src/Reusable/Header.php'; ?>
        <div class="appContainer">
            <div class="studentDashboard">
                <span style="font-size: 25px; font-weight: bold;">Start your evaluation</span>
                <?php if ($result->num_rows > 0): ?>
                <div class="candidate">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <a href="<?php echo '/vote?lecturer=' . $row['id']; ?>">
                    <div class="item d-flex">
                        <div class="image">
                            <img src="<?php echo 'src/Upload/' .
                                $row['photo']; ?>"
                                alt="">
                        </div>
                        <div class="detail d-flex flex-column justify-content-center">
                            <h5 class="font-weight-bold"><?php echo $row[
                                'name'
                            ]; ?></h5>
                         
                        </div>
                    </div>
                    </a>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>