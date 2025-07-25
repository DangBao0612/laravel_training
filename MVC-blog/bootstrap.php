<?php
require __DIR__.'/vendor/autoload.php';
session_start();

define('BASE_URI', '/MVC-blog/public'); 
$cfg = require __DIR__.'/config/database.php';   
$pdo = new PDO(
    $cfg['dsn'],
    $cfg['user'],
    $cfg['pass'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
App\Models\BaseModel::setPdo($pdo);

/* ==== Remember‑me restore ==== */
if (empty($_SESSION['uid']) && !empty($_COOKIE['remember'])) {
    require_once __DIR__.'/app/Models/User.php';

    $uid = App\Models\User::findIdByRemember($_COOKIE['remember']);
    if ($uid) {
        $_SESSION['uid'] = $uid;
        // (tuỳ chọn) đổi token mới để tránh bị đánh cắp:
        /*
        $new = bin2hex(random_bytes(32));
        setcookie('remember', $new, time()+60*60*24*30, '/');
        App\Models\User::updateRemember($uid, $new);
        */
    } else {
        // Cookie không hợp lệ -> xoá
        setcookie('remember','', time()-3600,'/');
    }
}




