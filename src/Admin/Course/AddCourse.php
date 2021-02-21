<?php
session_start();

include 'src/Config/Database.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    if (empty($name)) {
        $errorMessage = 'Validation Error: course name is required';

        $_SESSION['error'] = $errorMessage;

        unset($_SESSION['success']);

        header('Location: /add-course');
    } else {
        $sql = "INSERT INTO course (name) VALUES ('$name')";

        if ($con->query($sql) === true) {
            $successMessage = 'Course added successfully';
            $_SESSION['success'] = 'Course added successfully';

            unset($_SESSION['error']);

            header('Location: /add-course');
        } else {
            $errorMessage = 'Error: Failed to add course';

            $_SESSION['error'] = $errorMessage;

            unset($_SESSION['success']);

            header('Location: /add-course');
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
    <title>Add Course</title>
</head>

<body>
    <div class="admin">
        <?php require 'src/Reusable/Header.php'; ?>
        <div class="appContainer">
            <div class="adminDashboard">
                <?php require 'src/Reusable/AdminTab.php'; ?>
                <div class="addItem">
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['error']; ?>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['success']; ?>
                    </div>
                    <?php endif; ?>
                    <form action="/add-course" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="name of course" name="name">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>