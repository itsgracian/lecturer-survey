<?php
session_start();

include 'src/Config/Database.php';

include 'src/Auth/IsAuth.php';

$URI = $_SERVER['REQUEST_URI'];

$success = 'loginSuccess';

$error = 'loginError';



if (isset($_POST['submit'])) {
    $regNumber = $_POST['regNumber'];

    $password = $_POST['password'];

    if (empty($regNumber) || empty($password)) {
        $_SESSION[$error] = 'reg number and password is required';

        unset($_SESSION[$success]);

        header("Location: $URI");
    } else {
        $checkReg = "SELECT * FROM `users` WHERE regNumber='$regNumber'";

        $result = $con->query($checkReg);

        if ($result->num_rows === 0) {
            $_SESSION[$error] = 'Incorrect reg number';

            unset($_SESSION[$success]);

            header("Location: $URI");
        } else {
            while ($row = $result->fetch_assoc()) {
                $hashedPassword = $row['password'];

                if (password_verify($password, $hashedPassword)) {
                    unset($_SESSION[$error]);

                    $_SESSION[$loggedIn] = $row['id'];

                    $_SESSION['username'] = $row['name'];

                    if ($row['userType'] === $role[1]) {
                        header('Location: /admin');
                    } else {
                        header('Location: /student');
                    }
                } else {
                    $_SESSION[$error] = 'Incorrect password';

                    unset($_SESSION[$success]);

                    header("Location: $URI");
                }
            }
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
    <link rel="stylesheet" href="src/Asset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/Asset/css/Style.css">
    <title>Lecturer | Login</title>
</head>

<body>
    <div class="login d-flex justify-content-center align-items-center">
        <form action="/" method="POST">
        <?php if (isset($_SESSION[$error])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION[$error]; ?>
                </div>
                <?php endif; ?>
        <div class="authForm">
            <div class="form-group">
                <input type="text" class="form-control" name="regNumber" placeholder="reg number" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Login</button>
            </div>
        </div>
        </form>
    </div>
</body>

</html>