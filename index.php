<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

$router = new Router;
$router->runController();

class Router
{
    public function runController()
    {
        switch ($_SERVER['REQUEST_URI']) {
            case '/':
                include(__DIR__ . '/protected/views/form.php');
                break;
            case '/form':
                include(__DIR__ . '/protected/controllers/UserController.php');
                UserController::addUser();
                break;
            case '/login':
                include(__DIR__ . '/protected/controllers/UserController.php');
                UserController::login();
                break;
            case '/authorize':
                include(__DIR__ . '/protected/controllers/UserController.php');
                UserController::authorize();
                break;
            case '/logout':
                include(__DIR__ . '/protected/controllers/UserController.php');
                UserController::logout();
                break;
            case '/aboutmyself':
                include(__DIR__ . '/protected/controllers/UserController.php');
                UserController::getUserInfo();
                break;
            default:
                include(__DIR__ . '/protected/views/404NotFound.php');
        }
    }
}