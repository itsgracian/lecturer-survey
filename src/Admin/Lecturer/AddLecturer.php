<?php
session_start();

include 'src/Config/Database.php';

$request = $_SERVER['REQUEST_URI'];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];

    $photo = $_FILES['photo'];

    if (empty($name) || empty($photo)) {
        $_SESSION['lError'] = 'Validation Error: All field are required';

        header("Location: $request");
    } else {
        //first upload photo
        $uploadDir = 'src/Upload/';

        $uploadFile = $uploadDir . basename($photo['name']);

        if (move_uploaded_file($photo['tmp_name'], $uploadFile)) {
            $fileName = $photo['name'];

            $sql = "INSERT INTO lecturer(name, photo) VALUES ('$name', '$fileName')";

            if($con->query($sql)){
                unset($_SESSION['lError']);

                $_SESSION['lSuccess'] = 'Lecturer added successfully';

                header("Location: $request");
            }

        } else {
            $_SESSION['lError'] = 'Upload Error: Failed to upload image';

            unset($_SESSION['lSuccess']);

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
    <link rel="stylesheet" href="src/Asset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/Asset/css/Style.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <title>Add Lecturer</title>
</head>

<body>
    <div class="admin">
        <?php require 'src/Reusable/Header.php'; ?>
        <div class="appContainer">
            <div class="adminDashboard">
                <?php require 'src/Reusable/AdminTab.php'; ?>
                <div class="addItem">
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <?php if (isset($_SESSION['lError'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['lError']; ?>
                        </div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['lSuccess'])): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['lSuccess']; ?>
                        </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required placeholder="lecturer names">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Image</label>
                            <input type="file" class="form-control" name="photo" required>
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