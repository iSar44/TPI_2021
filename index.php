<?php
require_once('./src/model/classes/session.php');

Session::getInstance();

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {
    case '':
        require __DIR__ . '/src/public/views/home.php';
        break;
    case 'login':
        require __DIR__ . '/src/public/views/login.php';
        break;
    case 'logout' && isset($_SESSION['isLoggedIn']):
        require __DIR__ . '/src/public/views/logout.php';
        break;
        //Issue with redirection 
    case 'create' && isset($_SESSION['isLoggedIn']):
        require __DIR__ . '/src/public/views/createTournament.php';
        break;
    default:
        http_response_code(404);
        break;
}
