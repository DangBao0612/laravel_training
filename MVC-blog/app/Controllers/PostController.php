<?php
namespace App\Controllers;

use App\Models\Post;

class PostController
{
    /* Danh sách bài – route GET '/' */
    public function index(): void
    {
         \App\Middleware\AuthMiddleware::handle();
        if (empty($_SESSION['uid'])) {
            header('Location: ' . BASE_URI . '/login');
            exit;
        }
        $_SESSION['csrf'] = $_SESSION['csrf'] ?? bin2hex(random_bytes(16)); // Luôn sinh token CSRF để đảm bảo views post/index.php có giá trị

        $posts = Post::all();
        require __DIR__.'/../Views/posts/index.php';
    }

    // Form tạo bài 
    public function create(): void
    {
         \App\Middleware\AuthMiddleware::handle();

        $this->guard();
        $errors = $_SESSION['errors'] ?? [];
        $old = $_SESSION['old'] ?? [];
        unset($_SESSION['errors'], $_SESSION['old']);

        require __DIR__.'/../Views/posts/create.php';
    }

    /* Lưu bài mới – POST /posts */
    public function store(): void
    {
         \App\Middleware\AuthMiddleware::handle();
        $this->guard();  
        $this->verifyCsrf();

        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        // Validator
         $v = (new \App\Core\Validator)
        ->required('title', $title)
        ->required('content', $content);

        if ($v->fails()) {
            $_SESSION['errors'] = $v->errors();
            $_SESSION['old'] = $_POST;
            header('Location: ' . BASE_URI . '/posts/create');
            exit;
        }

        Post::create([
            'uid'     => $_SESSION['uid'],
            'title'   => $title,
            'content' => $content,
        ]);
        header('Location: ' . BASE_URI . '/');
        exit;
    }

    // Form sửa 
    public function edit(int $id): void
    {
         \App\Middleware\AuthMiddleware::handle();
        $this->guard();
        $post = Post::find($id) ?: $this->notFound();

        $errors = $_SESSION['errors'] ?? [];
        $old = $_SESSION['old'] ?? [];
        unset($_SESSION['errors'], $_SESSION['old']);

        require __DIR__.'/../Views/posts/edit.php';
    }

    // Cập nhật Post
    public function update(int $id): void
    {
         \App\Middleware\AuthMiddleware::handle();
        $this->guard();  $this->verifyCsrf();

        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        $v = (new \App\Core\Validator)
        ->required('title', $title)
        ->required('content', $content);

        if ($v->fails()) {
        $_SESSION['errors'] = $v->errors();
        $_SESSION['old'] = $_POST;
        header('Location: ' . BASE_URI . "/posts/$id/edit");
        exit;
        }

        Post::update($id, ['title'=>$title, 'content'=>$content]);
        header('Location: ' . BASE_URI . '/');
        exit;
    }

    /* Xoá – POST /posts/{id}/delete */
    public function destroy(int $id): void
    {
         \App\Middleware\AuthMiddleware::handle();
        $this->guard();  $this->verifyCsrf();
        Post::delete($id);
        header('Location: ' . BASE_URI . '/');
        exit;
    }

    // Helper 

    private function guard(): void
    {
        if (empty($_SESSION['uid'])) {
            header('Location: ' . BASE_URI . '/login');
            exit;
        }
    }

    private function verifyCsrf(): void
    {
        if (($_POST['csrf'] ?? '') !== ($_SESSION['csrf'] ?? '')) {
            http_response_code(419);
            exit('CSRF mismatch');
        }
    }

    private function notFound(): void
    {
        http_response_code(404);
        exit('Post not found');
    }
    
}
