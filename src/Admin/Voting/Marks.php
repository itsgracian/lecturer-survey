<?php
session_start();

include 'src/Config/Database.php';

$lecturerId = $_GET['lecturer'];

$courseId = $_GET['course'];

if (!isset($lecturerId) && !isset($courseId)) {
    header('Location:/admin-voting');
}

$sql = "SELECT course.name as courseName, vote.lecturerId as lecturerId, SUM(vote.marks) as totalMarks FROM vote, course 
WHERE vote.courseId = '$courseId' AND vote.courseId =course.id AND vote.lecturerId='$lecturerId' GROUP BY vote.lecturerId";

$result = $con->query($sql);

$lectSql = "SELECT lecturer.name, lecturer.photo FROM lecturer WHERE lecturer.id ='$lecturerId'";

$lecturerResult = $con->query($lectSql);
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
    <title>Total Marks of lecturer per course</title>
</head>

<body>
    <div class="admin">
        <?php require 'src/Reusable/Header.php'; ?>
        <div class="appContainer">
            <div class="adminDashboard">
                <?php require 'src/Reusable/AdminTab.php'; ?>
                <div class="course">
                    <?php if ($lecturerResult->num_rows > 0): ?>
                    <?php while ($r = $lecturerResult->fetch_assoc()): ?>
                    <div class="userInformation d-flex align-items-center" style="margin-left: 30px">
                        <div class="avatar">
                            <img src="<?php echo '/src/Upload/' .
                                $r['photo']; ?>" alt="">
                        </div>
                        <div class="detail">
                            <span>
                                <?php echo $r['name']; ?>
                            </span>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                    <?php if ($result->num_rows > 0): ?>
                    <ul>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <li>
                            <div class="name flex-column d-flex justify-content-start lecturerInfo">
                                <span>
                                    <?php echo $row['courseName']; ?>
                                </span>
                                <small>
                                    <?php echo 'total marks: ' .
                                        $row['totalMarks']; ?>
                                </small>
                            </div>
                            <div class="action d-flex justify-content-center align-items-center">
                            <!-- <span style="font-size: 20px; font-weight: bold">
                                        <?php echo $row['totalMarks'] / 100 .
                                            '%'; ?>
                                    </span> -->
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