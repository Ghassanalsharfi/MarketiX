<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('ROOT_PATH', dirname(__DIR__, 2));
define('BASE_URL', '/MarketiX');

date_default_timezone_set('Asia/Aden');
