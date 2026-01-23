<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';

requireAuth($pdo);

include ROOT_PATH . '/views/orders/success.php';
