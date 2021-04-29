<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case $request:
        require __DIR__ . '/public/home.php';
        break;
    default:
        http_response_code(404);
        break;
}
