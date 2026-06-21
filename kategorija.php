<?php
require 'db.php';
require 'functions.php';
$categoriesForMenu = fetchCategories($dbc);

$categoryKey = $_GET['kategorija'] ?? 'politika';
$order = $_GET['sort'] ?? 'najnovije';
$categoryName = categoryNameFromKey($categoryKey);

$orderSql = 'v.datum_objave DESC';
if ($order === 'najstarije') {
    $orderSql = 'v.datum_objave ASC';
} elseif ($order === 'az') {
    $orderSql = 'v.naslov ASC';
}

$stmtCategory = mysqli_prepare($dbc, "SELECT id_kategorija, naziv FROM kategorije WHERE naziv = ? LIMIT 1");
mysqli_stmt_bind_param($stmtCategory, 's', $categoryName);
mysqli_stmt_execute($stmtCategory);
$categoryResult = mysqli_stmt_get_result($stmtCategory);
$category = mysqli_fetch_assoc($categoryResult);

if (!$category) {
    http_response_code(404);
    $category = array('id_kategorija' => 0, 'naziv' => 'Kategorija nije pronađena');
}

$query = "SELECT v.id_vijest, v.naslov, v.sazetak, v.slika, v.datum_objave, k.naziv AS kategorija
          FROM vijesti v
          INNER JOIN kategorije k ON v.id_kategorija = k.id_kategorija
          WHERE v.id_kategorija = ?
          ORDER BY $orderSql";
$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, 'i', $category['id_kategorija']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($category['naziv']); ?> - Le Nouvel Observateur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,500..900;1,6..96,500..900&family=Libre+Baskerville:wght@400;700&family=Inter:wght@500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css?v=2">
</head>
<body>
<?php include 'header.php'; ?>

<main class="category-page container">
    <h2 class="category-title"><?php echo e($category['naziv']); ?></h2>
    <p class="category-intro">Pregled svih vijesti iz odabrane rubrike.</p>

    <div class="filter-bar">
        <a class="<?php echo $order === 'najnovije' ? 'active' : ''; ?>" href="kategorija.php?kategorija=<?php echo urlencode($categoryKey); ?>&sort=najnovije">Najnovije</a>
        <a class="<?php echo $order === 'najstarije' ? 'active' : ''; ?>" href="kategorija.php?kategorija=<?php echo urlencode($categoryKey); ?>&sort=najstarije">Najstarije</a>
        <a class="<?php echo $order === 'az' ? 'active' : ''; ?>" href="kategorija.php?kategorija=<?php echo urlencode($categoryKey); ?>&sort=az">A-Z</a>
    </div>

    <div class="card-grid category-grid">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($article = mysqli_fetch_assoc($result)): ?>
                <article class="news-card">
                    <a href="clanak.php?id=<?php echo (int)$article['id_vijest']; ?>">
                        <img src="images/<?php echo e($article['slika']); ?>" alt="<?php echo e($article['naslov']); ?>">
                    </a>
                    <div class="card-content">
                        <h3><a href="clanak.php?id=<?php echo (int)$article['id_vijest']; ?>"><?php echo e($article['naslov']); ?></a></h3>
                        <p><?php echo e($article['kategorija']); ?> — <?php echo formatDateHr($article['datum_objave']); ?></p>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="empty-state">U ovoj rubrici trenutačno nema objavljenih vijesti.</p>
        <?php endif; ?>
    </div>
</main>

<?php if (isAdminLoggedIn()): ?>
    <a class="floating-add" href="unos.php" aria-label="Dodaj vijest">+</a>
<?php endif; ?>

<?php include 'footer.php'; ?>
</body>
</html>
