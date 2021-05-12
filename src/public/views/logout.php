<?php
require_once('./src/web.inc.all.php');

unset($u_controller);
session_destroy();

header('Location: ./');
