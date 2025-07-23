<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Posts</h2>

<?php foreach ($posts as $p): ?>
  <article>
    <h3><?= htmlspecialchars($p['title']) ?></h3>
    <p><?= nl2br(htmlspecialchars($p['content'])) ?></p>

    <footer style="margin-top:4px">
      <small>
        by <?= htmlspecialchars($p['email']) ?>
        | <a href="<?= BASE_URI ?>/posts/<?= $p['id'] ?>/edit">Edit</a>
      </small>

      <!-- Delete inline -->
      <form action="<?= BASE_URI ?>/posts/<?= $p['id'] ?>/delete"
            method="post"
            style="display:inline;margin-left:8px"
            onsubmit="return confirm('Delete this post?');">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <button type="submit">Delete</button>
      </form>
    </footer>
  </article>
  <hr>
<?php endforeach; ?>
