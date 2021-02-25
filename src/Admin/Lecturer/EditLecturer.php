<?php
session_start();

include 'src/Config/Database.php';

$request = $_SERVER['REQUEST_URI'];

$name = '';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    //do
    $id = $_GET['id'];
    $sql = "SELECT * FROM lecturer WHERE id='$id'";

    if ($con->query($sql)) {
        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
        }
    }
} else {
    $_SESSION['serverError'] = 'Error: Something went wrong try again';
    header('Location: /admin');
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];

    $photo = $_FILES['photo'];

    $id = $_GET['id'];

    if (empty($name) || empty($photo)) {
        $_SESSION['lUError'] = 'Validation Error: All field are required';

        header("Location: $request");
    } else {
        //first upload photo
        $uploadDir = 'src/Upload/';

        $uploadFile = $uploadDir . basename($photo['name']);

        if (move_uploaded_file($photo['tmp_name'], $uploadFile)) {
            $fileName = $photo['name'];

            $sql = "UPDATE lecturer SET name='$name', photo='$fileName' WHERE id='$id'";

            if ($con->query($sql)) {
                unset($_SESSION['lUError']);

                $_SESSION['lUSuccess'] = 'Lecturer updated successfully';

                header("Location: $request");
            }
        } else {
            $_SESSION['lUError'] = 'Upload Error: Failed to upload image';

            unset($_SESSION['lUSuccess']);

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
    <title>Edit Lecturer</title>
</head>

<body>
    <div class="admin">
        <?php require 'src/Reusable/Header.php'; ?>
        <div class="appContainer">
            <div class="adminDashboard">
                <?php require 'src/Reusable/AdminTab.php'; ?>
                <div class="addItem">
                    <form method="POST" action="<?php $_SERVER[
                        'PHP_SELF'
                    ]; ?>" enctype="multipart/form-data">
                        <?php if (isset($_SESSION['lUError'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['lUError']; ?>
                        </div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['lUSuccess'])): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['lUSuccess']; ?>
                        </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required placeholder="lecturer names"
                                value="<?php echo $name; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Image</label>
                            <input type="file" class="form-control" name="photo" required accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>