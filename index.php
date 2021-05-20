<?php
require_once('./src/model/classes/session.php');

date_default_timezone_set('CET');

Session::getInstance();

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {
    case '':
        require __DIR__ . '/src/public/views/home.php';
        break;
    case 'login':
        require __DIR__ . '/src/public/views/login.php';
        break;
    case 'logout':
        if (isset($_SESSION['isLoggedIn'])) {
            require __DIR__ . '/src/public/views/logout.php';
        }
        break;
    case 'create':
        if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1) {
            require __DIR__ . '/src/public/views/createTournament.php';
        }
        break;
    case 'delete':
        if (isset($_SESSION['isLoggedIn'])) {
            require __DIR__ . '/src/public/views/home.php';
        }
        break;
    case 'edit':
        if (isset($_SESSION['isLoggedIn'])) {
            require __DIR__ . '/src/public/views/edit.php';
        }
        break;
    case 'getDetails':
        if (isset($_SESSION['isLoggedIn'])) {
            require __DIR__ . '/src/public/views/getDetails.php';
        }
    case 'test':
        if (isset($_SESSION['isLoggedIn'])) {
            require __DIR__ . '/src/tests/test_tournament.php';
            // require __DIR__ . '/src/functions/index.php';
        }
        break;
    default:
        http_response_code(404);
        break;
}
