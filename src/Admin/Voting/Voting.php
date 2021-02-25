<?php
include 'src/Config/Database.php';

$sql = 'SELECT lecturer.name AS lecturerName, lecturer.id as lecturerId, COUNT(vote.courseId) as numberOfCourse, 
    COUNT(vote.userId) as numberOfUser FROM vote, lecturer WHERE vote.lecturerId=lecturer.id GROUP BY vote.lecturerId 
    ORDER BY numberOfCourse DESC';

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
    <link rel="stylesheet" href="src/Asset/css/Style.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <title>Voting</title>
</head>

<body>
    <div class="admin">
        <?php require 'src/Reusable/Header.php'; ?>
        <div class="appContainer">
            <div class="adminDashboard">
                <?php require 'src/Reusable/AdminTab.php'; ?>
                <div class="course">
                    <?php if ($result->num_rows > 0): ?>
                 
                    <ul>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <li>
                            <div class="name flex-column d-flex justify-content-start lecturerInfo">
                                <span>
                                    <?php echo $row['lecturerName']; ?>
                                </span>
                                <small><?php echo 'number of times was he/she evaluated on different courses: ' .
                                    $row['numberOfUser']; ?></small>
                            </div>
                            <div class="action d-flex justify-content-center align-items-center">
                                <a href="/voted-lecturer?lecturer=<?php echo $row[
                                    'lecturerId'
                                ]; ?>">
                                    <button type="button" style="border: 1px solid #ddd; font-size: 15px; padding: 5px; font-weight: bold; background: black; color: white; border-radius: 30px;">
                                        <small>courses</small>
                                    </button>
                                </a>
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