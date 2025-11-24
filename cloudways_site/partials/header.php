<?php require_once __DIR__ . '/../includes/functions.php'; ?>
<!doctype html>
<?php echo "<!-- HEADER TEST " . __FILE__ . " -->"; ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Josh Ingram</title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
 <header class="site-header">
  <div class="container header-inner">
    <div class="brand"><a href="/index.php">Josh Ingram</a></div>
    <div class="menu-toggle" onclick="toggleMenu()">☰ Menu</div>
    <nav class="main-nav">
      <a href="/index.php">Home</a>
      <a href="/projects.php">Projects</a>
      <a href="/about.php">About</a>
      <a href="/contact.php">Contact</a>
    </nav>
  </div>
</header>

<script>
function toggleMenu(){
  const nav=document.querySelector('.main-nav');
  nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
}
</script>

  <main class="site-content container">
