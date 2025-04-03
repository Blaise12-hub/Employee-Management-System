<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Controllers\EmployeeController;
use App\Controllers\AttendanceController;


// $router->post('/mark-attendance', [AttendanceController::class, 'mark']);
// $router->get('/mark-attendance', function() {
//     include __DIR__ . '/../views/mark_attendance.php';
// });

define('VIEW_PATH',__DIR__ . '/../app/Views');


// Get the current URI and remove query strings
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$routes = [
    'employees'         => [EmployeeController::class, 'index'],
    'employees/add'     => [EmployeeController::class, 'addEmployee'],
    'attendance'        => [AttendanceController::class, 'report'],
    'attendance/mark'   => [AttendanceController::class, 'mark'],
];

if (isset($routes[$uri])) {
    $controller = new $routes[$uri][0]();
    $method = $routes[$uri][1];
    $controller->$method();
} else {
    http_response_code(404);
    echo "404 Not Found!  Oops,Try again";
}


















// $uri = trim($_SERVER['REQUEST_URI'], '/');
// $controller = new EmployeeController();

// if ($uri == 'employees') {
//     $controller=new EmployeeController();
//     $controller->index();
// } elseif ($uri == 'employees/add') {
//     $controller=new EmployeeController();
//     $controller->addEmployee();
// } elseif ($uri == 'attendance') {
//     $controller=new AttendanceController();
//     $controller->report();
// }  elseif ($uri == 'attendance/mark') {
//     $controller=new AttendanceController();
//     $controller->mark();    
// } else {
//     echo "404 Not Found";
// }

?>