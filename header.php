<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'functions.php';
if (!isset($categoriesForMenu)) {
    require_once 'db.php';
    $categoriesForMenu = fetchCategories($dbc);
}
?>
<header class="site-header">
    <h1 class="logo"><a href="index.php">L'OBS</a></h1>
    <nav class="main-nav">
        <a href="index.php">Home</a>
        <?php foreach ($categoriesForMenu as $categoryItem): ?>
            <a href="kategorija.php?kategorija=<?php echo urlencode(categoryKey($categoryItem['naziv'])); ?>">
                <?php echo e($categoryItem['naziv']); ?>
            </a>
        <?php endforeach; ?>
        <a href="administrator.php">Administracija</a>
        <?php if (isAdminLoggedIn()): ?>
            <a href="logout.php">Odjava</a>
        <?php endif; ?>
    </nav>
</header>
