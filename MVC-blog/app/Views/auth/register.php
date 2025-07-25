<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <style>
    body{font-family:sans-serif;max-width:480px;margin:40px auto;}
    label{display:block;margin:12px 0;}
  </style>
</head>
<body>
<h1>Register</h1>

<?php if (!empty($_SESSION['errors'])): ?>
    <ul style="color:red">
    <?php foreach ($_SESSION['errors'] as $arr)
        foreach ($arr as $e) echo "$e"; ?>
    </ul>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>


<form action="<?= BASE_URI ?>/register" method="post">
  <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?? '' ?>">

  <label>
    Email
    <input type="email" name="email" required autofocus>
  </label>

  <label>
    Password (≥ 6 chars)
    <input type="password" name="password" required minlength="6">
  </label>

  <label>
    Confirm password
    <input type="password" name="confirm" required minlength="6">
  </label>

  <button type="submit">Register</button>
</form>

<p><a href="<?= BASE_URI ?>/login">Already have an account? Login</a></p>
</body>
</html>
