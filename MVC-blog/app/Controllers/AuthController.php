<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\Validator;
// Xử lý đăng ký / đăng nhập / logout

class AuthController
{

    
    // Hiển thị form 

    public function showLogin(): void
    {
        \App\Middleware\GuestMiddleware::handle();
        $_SESSION['csrf'] = bin2hex(random_bytes(16));     // tạo token CSRF mới
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function showRegister(): void
    {
        \App\Middleware\GuestMiddleware::handle();
        $_SESSION['csrf'] = bin2hex(random_bytes(16));  // tạo token CSRF mới
        require __DIR__ . '/../Views/auth/register.php';
    }

    // Xử lý post 

    // Đăng ký
    public function register(): void
    {
        \App\Middleware\GuestMiddleware::handle();
        $this->verifyCsrf();

        $email   = trim($_POST['email']    ?? '');
        $pass    =       $_POST['password'] ?? '';
        $confirm =       $_POST['confirm']  ?? '';

        // Validate 
        $v = (new Validator)
        ->required('email', $email)
        ->email('email', $email)
        ->required('password', $pass)
        ->min('password', $pass, 6);

        // Kiểm tra xác nhận mk
        if ($pass !== $confirm) {
        $v->addError('confirm', 'Mật khẩu xác nhận không khớp');
        }

        // Kiểm tra email đăng ký đã tồn tại
         if (User::findByEmail($email)) {
        $v->addError('email', 'Email đã tồn tại');
        }

        if ($v->fails()) {
        $_SESSION['errors'] = $v->errors();
        $_SESSION['old'] = $_POST; // Giữ lại giá trị cũ để hiển thị lại trên form
        header('Location: ' . BASE_URI . '/register');
        exit;
        }

        // Tạo user 
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        User::create($email, $hash);

        // Auto‑login & redirect 
        $_SESSION['uid'] = User::findByEmail($email)['id'];
        header('Location: ' . BASE_URI . '/');
        exit;
    }

    public function login(): void
    {
        \App\Middleware\GuestMiddleware::handle();
        $this->verifyCsrf();

        $email = trim($_POST['email'] ?? '');
        $pass  =       $_POST['password'] ?? '';

        $user = User::findByEmail($email);
        if (!$user || !password_verify($pass, $user['password_hash'])) {
            $this->flashAndBack('/login', 'Sai email hoặc mật khẩu');
        }

        // Đăng nhập thành công 
        $_SESSION['uid'] = $user['id'];

        // Remember‑me 
        if (!empty($_POST['remember'])) {
            $token = bin2hex(random_bytes(32));
            setcookie('remember', $token, time() + 60*60*24*30, '/'); // Tạo cookie ghi nhớ đăng nhập
            User::updateRemember($user['id'], $token);
        }

        header('Location: ' . BASE_URI . '/');
        exit;
    }

    public function logout(): void
    {
         \App\Middleware\AuthMiddleware::handle();
        if (isset($_COOKIE['remember'])) {
            setcookie('remember', '', time() - 3600, '/');
        }
        session_destroy();
        header('Location: ' . BASE_URI . '/login');
        exit;
    }

    // Helper

    // Kiểm tra CSRF
    private function verifyCsrf(): void
    {
        if (($_POST['csrf'] ?? '') !== ($_SESSION['csrf'] ?? '')) { // Check token hợp lệ
            http_response_code(419);
            exit('CSRF token mismatch');
        }
    }

    // Lưu flash message rồi quay lại trang form
    private function flashAndBack(string $path, string $msg): void
    {
        $_SESSION['flash'] = $msg;
         if ($path[0] === '/') { // Nếu $path bắt đầu = / => Redirect đến đường dẫn /login - TB sai mk => Ghép BASE_URI để trình duyệt đi đến đúng vị trị khởi tạo dự án 
        $path = BASE_URI . $path;
    }
        header('Location: ' . $path);
        exit;
    }

    
}
