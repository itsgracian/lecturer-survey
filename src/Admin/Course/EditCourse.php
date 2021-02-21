<?php
session_start();

include 'src/Config/Database.php';

$name = '';

$request = $_SERVER['REQUEST_URI'];

if (isset($_GET['id'])) {
    if (empty($_GET['id'])) {
        $_SESSION['serverError'] = 'Error: Something went wrong try again';
        header('location:javascript://history.go(-1)');
    } else {
        //do
        $courseId = $_GET['id'];
        $sql = "SELECT * FROM course WHERE id='$courseId'";

        if ($con->query($sql)) {
            $result = $con->query($sql);
            while ($row = $result->fetch_assoc()) {
                $name = $row['name'];
            }
        }
    }
} else {
    header('location:javascript://history.go(-1)');
}

//
if (isset($_POST['update']) && isset($_GET['id'])) {
    $courseName = $_POST['name'];

    $courseId = $_GET['id'];

    if (empty($courseName)) {
        $_SESSION['uError'] = 'Validation Error: course name is required';

        unset($_SESSION['uSuccess']);

        header("Location: $request");
    } else {
        $sql = "UPDATE courses SET name='$courseName' WHERE id='$courseId'";

        if ($con->query($sql)) {
            $_SESSION['uSuccess'] = 'Updated successfully';

            unset($_SESSION['uError']);

            header("Location: $request");
        } else {
            $_SESSION['uError'] = 'Error: Failed to update course';

            unset($_SESSION['uSuccess']);

            header("Location: $request");
        }
    }
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
    <link rel="stylesheet" href="src/Asset/css/Style.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <title>Edit Course</title>
</head>

<body>
    <div class="admin">
        <?php require 'src/Reusable/Header.php'; ?>
        <div class="appContainer">
            <div class="adminDashboard">
                <?php require 'src/Reusable/AdminTab.php'; ?>
                <div class="addItem">
                <?php if (isset($_SESSION['uError'])): ?>
                        <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['uError']; ?>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['uSuccess'])): ?>
                        <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['uSuccess']; ?>
                    </div>
                    <?php endif; ?>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" required placeholder="name of course" 
                            value="<?php echo $name; ?>" name="name">
                        </div>
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>