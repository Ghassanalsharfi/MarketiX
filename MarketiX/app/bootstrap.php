<?php
/**
 * bootstrap.php
 * نقطة الدخول المركزية للمشروع
 */

// 1️⃣ تشغيل الجلسة
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2️⃣ تحميل الإعدادات العامة
require_once __DIR__ . '/config/app.php';

// 3️⃣ الاتصال بقاعدة البيانات
require_once ROOT_PATH . '/app/config/database.php';
require_once ROOT_PATH . '/app/helpers/ActivityLogger.php';

// 4️⃣ Autoload للكلاسات
spl_autoload_register(function ($class) {
    $paths = [
        ROOT_PATH . '/app/controllers/',
        ROOT_PATH . '/app/models/',
        ROOT_PATH . '/app/middleware/',
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
}


);


