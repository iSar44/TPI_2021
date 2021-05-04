<?php
require_once('./src/model/classes/session.php');

$session = Session::getInstance();

//$request = $_SERVER['REQUEST_URI'];

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {
    case '':
        require __DIR__ . '/src/public/views/home.php';
        break;
    case 'login':
        require __DIR__ . '/src/public/views/login.php';
    default:
        http_response_code(404);
        break;
}
