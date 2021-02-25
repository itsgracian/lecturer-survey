<?php
session_start();

include 'src/Config/Database.php';

$lecturerId = $_GET['lecturer'];
if (!isset($lecturerId)) {
    header('Location:/admin-voting');
}

$sql = "SELECT lecturer.name AS lecturerName, lecturer.id as lectureId, 
    course.name AS courseName, COUNT(vote.userId) as numberOfUser, 
    course.id as courseId, lecturer.photo as lecturerPhoto FROM vote, 
    lecturer, course WHERE vote.lecturerId=lecturer.id AND lecturer.id='$lecturerId' 
    AND course.id = vote.courseId GROUP BY vote.lecturerId, 
    course.name, course.id ORDER BY numberOfUser DESC";

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
                    <?php if ($lecturerResult->num_rows > 0): ?>
                        <?php while ($r = $lecturerResult->fetch_assoc()): ?>
                        <div class="userInformation d-flex align-items-center" style="margin-left: 30px">
                          <div class="avatar">
                              <img src="<?php echo '/src/Upload/' .
                                  $r['photo']; ?>" alt="">
                          </div>
                          <div class="detail">
                              <span><?php echo $r['name']; ?></span>
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
                                <small><?php echo 'number of users who evaluated him/her per course: ' .
                                    $row['numberOfUser']; ?></small>
                            </div>
                            <div class="action d-flex justify-content-center align-items-center">
                                <a href="/edit-lecturer?id=<?php echo $row[
                                    'id'
                                ]; ?>">
                                    <button type="button" style="border: 1px solid #ddd; font-size: 15px; padding: 5px; font-weight: bold; background: black; color: white; border-radius: 30px;">
                                        <small>percentages</small>
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