<?php
session_start();

include 'src/Config/Database.php';

$URI = $_SERVER['REQUEST_URI'];

$success = 'stSuccess';

$error = 'stError';



//
if (isset($_POST['submit'])) {
    $name = $_POST['name'];

    $regNumber = $_POST['regNumber'];

    $password = $_POST['password'];

    // validation

    if (empty($name) || empty($regNumber) || empty($password)) {
        $errorMessage = 'Validation Error: All field are required';

        $_SESSION[$error] = $errorMessage;

        unset($_SESSION[$success]);

        header('Location: /add-student');
    } else {
        $encryptPassword = password_hash($password, PASSWORD_DEFAULT);

        $studentRegNumber = strtoupper(str_replace(" ", "", $regNumber));

        $sql = "INSERT INTO users(name, regNumber, password) VALUES ('$name', '$studentRegNumber', '$encryptPassword')";

        if ($con->query($sql)) {
            $_SESSION[$success] = 'Student saved successfully';

            unset($_SESSION[$error]);

            header("Location: $URI");
        }else{
            $errorMessage = 'An error, occurred please try again';

            $_SESSION[$error] = $errorMessage;
    
            unset($_SESSION[$success]);

            header("Location: $URI");
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
    <title>Add Student</title>
</head>

<body>
    <div class="admin">
        <?php require 'src/Reusable/Header.php'; ?>
        <div class="appContainer">
            <div class="adminDashboard">
                <?php require 'src/Reusable/AdminTab.php'; ?>
                <div class="addItem">
                    <?php if (isset($_SESSION['stError'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['stError']; ?>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['stSuccess'])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['stSuccess']; ?>
                    </div>
                    <?php endif; ?>
                    <form action="/add-student" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="student name"
                                name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Reg Number</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                placeholder="registration number" name="regNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputEmail1" placeholder="password"
                                name="password" required>
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