<?php include __DIR__ . '/partials/header.php'; ?>
<section class="hero">
  <h1>Projects</h1>
  <div class="sort-controls">
    Sort by:
    <a href="?sort=date">Date</a> |
    <a href="?sort=title">Title</a>
  </div>
</section>
<section class="project-list">
  <?php foreach (get_projects() as $proj): ?>
    <div class="proj-card">
      <div class="proj-thumb">
        <img src="<?php echo htmlspecialchars($proj['thumb']); ?>" alt="<?php echo htmlspecialchars($proj['title']); ?>">
      </div>
      <div class="proj-info">
        <h3><a href="<?php echo htmlspecialchars($proj['link']); ?>"><?php echo htmlspecialchars($proj['title']); ?></a></h3>
        <p class="proj-date"><?php echo htmlspecialchars($proj['date']); ?></p>
        <p class="proj-excerpt"><?php echo htmlspecialchars($proj['excerpt']); ?></p>
        <?php if (!empty($proj['keywords'])): ?>
          <p class="proj-tags">Keywords: <?php echo implode(', ', $proj['keywords']); ?></p>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
</section>
<?php include __DIR__ . '/partials/footer.php'; ?>
