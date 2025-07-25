<?php require __DIR__.'/../layout/header.php'; ?>

<h2>Create post</h2>

<?php
$errors = $errors ?? ($_SESSION['errors'] ?? []);
$old = $old ?? ($_SESSION['old'] ?? []);
unset($_SESSION['errors'], $_SESSION['old']);
?>

<form action="<?= BASE_URI ?>/posts" method="post">
  <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
  
  <p>Title:<br>
    <input name="title" style="width:100%" value="<?= htmlspecialchars($old['title'] ?? '') ?>">
    <?php if (!empty($errors['title'])): ?>
      <br><span style="color:red"><?= $errors['title'][0] ?></span>
    <?php endif; ?>
  </p>

  <p>Content:<br>
    <textarea name="content" rows="6" style="width:100%"><?= htmlspecialchars($old['content'] ?? '') ?></textarea>
    <?php if (!empty($errors['content'])): ?>
      <br><span style="color:red"><?= $errors['content'][0] ?></span>
    <?php endif; ?>
  </p>

  <button>Create</button>
</form>
