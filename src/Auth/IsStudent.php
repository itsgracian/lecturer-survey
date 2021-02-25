<?php
include 'src/Config/Database.php';

if (isset($_SESSION[$loggedIn])) {
    $id = $_SESSION[$loggedIn];

    $q = "SELECT * FROM `users` WHERE id='$id'";

    $r = $con->query($q);

    if ($r->num_rows !== 0) {
        while ($row = $r->fetch_assoc()) {
            if ($row['userType'] !== $role[0]) {
                header('Location: /admin');
            }
        }
    }
}

?>
