<?php
include ('Router.php');

$request = $_SERVER['REQUEST_URI'];

$route = new Router($request);

$route->get('', 'src/Auth/Login');

$route->get('/home', 'src/Student/Student');



// switch ($request) {
//     case '/':
//     case '':
//         require __DIR__ . '/src/component/Auth/Login.php';
//         break;

//     default:
//         http_response_code(404);
//         require __DIR__ . '/src/component/404.php';
//         break;
// }

?>
