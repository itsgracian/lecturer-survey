
<?php
session_start();

include 'src/Config/Database.php';

include 'src/Auth/IsStudent.php';

$error = $_SESSION['fSError'];

$success = $_SESSION['fSSucess'];

$request = $_SERVER['REQUEST_URI'];

$lecturerId = $_GET['lecturer'];

if (!isset($lecturerId)) {
    header('Location: /student');
}

$sql = "SELECT * FROM `lecturer` WHERE id='$lecturerId'";

$query = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- CSS only -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="src/Asset/css/Style.css">
    <title>Start Voting</title>
</head>
<body>
    <div class="vote">
        <div class="closeVote">
            <a href="/student">
        <button type="button">
            <span class="fa fa-times"></span>
        </button></a>
        </div>
        <div class="voteContainer">
        <div class="container">
            <div class="row">
                <?php if ($query->num_rows !== 0): ?>
                    <?php while ($row = $query->fetch_assoc()): ?>
                      
                    <div class="lecturerInfo d-flex align-items-center">
                    <div class="avatar">
                        <img src="<?php echo '/src/Upload/' .
                            $row['photo']; ?>" alt="">
                    </div>
                    <div class="detail">
                        <span><?php echo $row['name']; ?></span>
                    </div>
                </div>
                <div class="voteForm">
                    <span class="heading">Evaluate your lecturer</span>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="">Provide marks</label>
                            <select name="grade" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option value="">Select marks</option>
                                <?php for ($i = 1; $i <= 100; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Course</label>
                            <select name="course" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option value="">Select course</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
                <?php if ($query->num_rows <= 0): ?>
                    <div class="voteForm">
                    <div class="alert alert-secondary" role="alert">
                        No result found
                    </div>
                    </div>
                    <?php endif; ?>
            </div>
        </div>
        </div>
        

    </div>
</body>
</html>