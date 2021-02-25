<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case parse_url($request, PHP_URL_PATH) === '/':
        require __DIR__ . '/src/Home/Home.php';
        break;

    case '/login':
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

    case parse_url($request, PHP_URL_PATH) === '/edit-course' &&
        parse_url($request, PHP_URL_QUERY):
        require __DIR__ . '/src/Admin/Course/EditCourse.php';
        break;

    case parse_url($request, PHP_URL_PATH) === '/edit-lecturer' &&
        parse_url($request, PHP_URL_QUERY):
        require __DIR__ . '/src/Admin/Lecturer/EditLecturer.php';
        break;

    case '/logout':
        require __DIR__ . '/src/Auth/Logout.php';
        break;

    case parse_url($request, PHP_URL_PATH) === '/vote' &&
        parse_url($request, PHP_URL_QUERY):
        require __DIR__ . '/src/Student/Vote.php';
        break;

    case '/admin-voting':
        require __DIR__ . '/src/Admin/Voting/Voting.php';
        break;

    case parse_url($request, PHP_URL_PATH) === '/voted-lecturer' &&
        parse_url($request, PHP_URL_QUERY):
        require __DIR__ . '/src/Admin/Voting/Course.php';
        break;

    case parse_url($request, PHP_URL_PATH) === '/total-marks-per-course' &&
        parse_url($request, PHP_URL_QUERY):
        require __DIR__ . '/src/Admin/Voting/Marks.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/src/404.php';
        break;
}

?>
