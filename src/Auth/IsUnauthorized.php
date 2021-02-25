<?php
include 'src/Config/Database.php';

if (!isset($_SESSION[$loggedIn])) {
    header('Location: /login');
}

?>
