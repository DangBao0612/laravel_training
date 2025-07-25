<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <style>
    body{font-family:sans-serif;max-width:480px;margin:40px auto;}
    label{display:block;margin:12px 0;}
  </style>
</head>
<body>
<h1>Login</h1>

<?php
// flash message 
if (!empty($_SESSION['flash'])) {
    echo '<p style="color:red">'.$_SESSION['flash'].'</p>';
    unset($_SESSION['flash']);
}
// thông báo lỗi nếu sai mk
if (!empty($_SESSION['flash'])) {
    echo '<p style="color:red">'.htmlspecialchars($_SESSION['flash']).'</p>';
    unset($_SESSION['flash']);
}
?>

<form action="<?= BASE_URI ?>/login" method="post">
    <!-- email / password / remember / csrf ... -->
</form>

<form action="<?= BASE_URI ?>/login" method="post">
  <!-- CSRF -->
  <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?? '' ?>">

  <label>
    Email
    <input type="email" name="email" required autofocus>
  </label>

  <label>
    Password
    <input type="password" name="password" required>
  </label>

  <label>
    <input type="checkbox" name="remember"> Remember me
  </label>

  <button type="submit">Login</button>
</form>

<p><a href="<?= BASE_URI ?>/register">Create a new account</a></p>
</body>
</html>
