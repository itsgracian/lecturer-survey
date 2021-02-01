<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
    case '':
        require __DIR__ . '/src/Auth/Login.php';
        break;

    case '/student':
        require __DIR__ . '/src/Student/Student.php';
        break;

    case '/admin':
        require __DIR__ . '/src/Admin/Dashboard.php';
        break;

    case '/lecturer':
        require __DIR__ . '/src/Admin/Lecturer/Lecturer.php';
        break;

    case '/add-lecturer':
        require __DIR__ . '/src/Admin/Lecturer/AddLecturer.php';
        break;

    case '/admin-student':
        require __DIR__ . '/src/Admin/Student/Student.php';
        break;

    case '/add-student':
        require __DIR__ . '/src/Admin/Student/AddStudent.php';
        break;

    case '/add-course':
        require __DIR__ . '/src/Admin/Course/AddCourse.php';
        break;

    case '/edit-course':
        require __DIR__ . '/src/Admin/Course/EditCourse.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/src/404.php';
        break;
}

?>
