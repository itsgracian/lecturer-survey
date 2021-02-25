<?php
session_start();

include '/src/Config/Database.php';

session_destroy();

unset($loggedIn);

header('Location: /');
?>
