<?php
require 'db.php';
require 'functions.php';
$categoriesForMenu = fetchCategories($dbc);

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = mysqli_prepare($dbc, "SELECT v.id_vijest, v.naslov, v.sazetak, v.tekst, v.slika, v.datum_objave, k.naziv AS kategorija, a.ime, a.prezime
                              FROM vijesti v
                              INNER JOIN kategorije k ON v.id_kategorija = k.id_kategorija
                              INNER JOIN admini a ON v.id_admin = a.id_admin
                              WHERE v.id_vijest = ?
                              LIMIT 1");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$article = mysqli_fetch_assoc($result);

if (!$article) {
    http_response_code(404);
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $article ? e($article['naslov']) : 'Članak nije pronađen'; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,500..900;1,6..96,500..900&family=Libre+Baskerville:wght@400;700&family=Inter:wght@500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css?v=2">
</head>
<body>
<?php include 'header.php'; ?>

<main class="article-page container">
    <?php if (!$article): ?>
        <section class="empty-state article-empty">Članak nije pronađen.</section>
    <?php else: ?>
        <div class="breadcrumb">
            <a href="index.php">Le Nouvel Observateur</a> &gt;
            <a href="kategorija.php?kategorija=<?php echo urlencode(categoryKey($article['kategorija'])); ?>"><?php echo e($article['kategorija']); ?></a>
        </div>

        <article class="single-article newspaper-article">
            <h2><?php echo e($article['naslov']); ?></h2>
            <img class="article-image" src="images/<?php echo e($article['slika']); ?>" alt="<?php echo e($article['naslov']); ?>">
            <p class="lead"><?php echo e($article['sazetak']); ?></p>
            <div class="date-box">
                Objavljeno <?php echo formatDateHr($article['datum_objave']); ?> — Urednik: <?php echo e($article['ime'] . ' ' . $article['prezime']); ?>
            </div>
            <div class="article-body">
                <?php echo nl2br(e($article['tekst'])); ?>
            </div>
        </article>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
