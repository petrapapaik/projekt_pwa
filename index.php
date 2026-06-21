<?php
require 'db.php';
require 'functions.php';
$categoriesForMenu = fetchCategories($dbc);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Nouvel Observateur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,500..900;1,6..96,500..900&family=Libre+Baskerville:wght@400;700&family=Inter:wght@500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css?v=2">
</head>
<body>
<?php include 'header.php'; ?>

<main class="homepage container">
    <?php foreach ($categoriesForMenu as $category): ?>
        <?php
            $stmt = mysqli_prepare($dbc, "SELECT id_vijest, naslov, sazetak, slika, datum_objave FROM vijesti WHERE id_kategorija = ? ORDER BY datum_objave DESC LIMIT 3");
            mysqli_stmt_bind_param($stmt, 'i', $category['id_kategorija']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $key = categoryKey($category['naziv']);
        ?>
        <section id="<?php echo e($key); ?>" class="news-section">
            <h2><?php echo e($category['naziv']); ?></h2>
            <div class="card-grid">
                <?php while ($article = mysqli_fetch_assoc($result)): ?>
                    <article class="news-card">
                        <a href="clanak.php?id=<?php echo (int)$article['id_vijest']; ?>">
                            <img src="images/<?php echo e($article['slika']); ?>" alt="<?php echo e($article['naslov']); ?>">
                        </a>
                        <div class="card-content">
                            <h3><a href="clanak.php?id=<?php echo (int)$article['id_vijest']; ?>"><?php echo e($article['naslov']); ?></a></h3>
                            <p><?php echo e($category['naziv']); ?> — <?php echo formatDateHr($article['datum_objave']); ?></p>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <div class="more-wrap">
                <a class="more-button" href="kategorija.php?kategorija=<?php echo urlencode($key); ?>">Više iz rubrike</a>
            </div>
        </section>
    <?php endforeach; ?>
</main>

<?php if (isAdminLoggedIn()): ?>
    <a class="floating-add" href="unos.php" aria-label="Dodaj vijest">+</a>
<?php endif; ?>

<?php include 'footer.php'; ?>
</body>
</html>
