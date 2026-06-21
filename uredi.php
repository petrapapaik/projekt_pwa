<?php
session_start();
require 'db.php';
require 'functions.php';
requireAdmin();
$categoriesForMenu = fetchCategories($dbc);

$id = isset($_GET['id']) ? (int)$_GET['id'] : (int)($_POST['id_vijest'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naslov = trim($_POST['naslov'] ?? '');
    $sazetak = trim($_POST['sazetak'] ?? '');
    $tekst = trim($_POST['tekst'] ?? '');
    $idKategorija = (int)($_POST['id_kategorija'] ?? 0);

    $stmt = mysqli_prepare($dbc, "UPDATE vijesti SET naslov = ?, sazetak = ?, tekst = ?, id_kategorija = ? WHERE id_vijest = ?");
    mysqli_stmt_bind_param($stmt, 'sssii', $naslov, $sazetak, $tekst, $idKategorija, $id);
    mysqli_stmt_execute($stmt);
    header('Location: administrator.php');
    exit;
}

$stmt = mysqli_prepare($dbc, "SELECT id_vijest, naslov, sazetak, tekst, id_kategorija FROM vijesti WHERE id_vijest = ? LIMIT 1");
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
    <title>Uredi vijest - Le Nouvel Observateur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,500..900;1,6..96,500..900&family=Libre+Baskerville:wght@400;700&family=Inter:wght@500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css?v=2">
</head>
<body>
<?php include 'header.php'; ?>
<main class="form-page container">
    <?php if (!$article): ?>
        <p class="empty-state">Vijest nije pronađena.</p>
    <?php else: ?>
        <section class="form-section">
            <h2>Uredi vijest</h2>
            <form class="form-box" method="POST" action="uredi.php">
                <input type="hidden" name="id_vijest" value="<?php echo (int)$article['id_vijest']; ?>">

                <label for="naslov">Naslov vijesti</label>
                <input type="text" id="naslov" name="naslov" value="<?php echo e($article['naslov']); ?>" required>

                <label for="sazetak">Kratki sažetak</label>
                <textarea id="sazetak" name="sazetak" rows="4" required><?php echo e($article['sazetak']); ?></textarea>

                <label for="tekst">Tekst vijesti</label>
                <textarea id="tekst" name="tekst" rows="12" required><?php echo e($article['tekst']); ?></textarea>

                <label for="id_kategorija">Kategorija</label>
                <select id="id_kategorija" name="id_kategorija" required>
                    <?php foreach ($categoriesForMenu as $category): ?>
                        <option value="<?php echo (int)$category['id_kategorija']; ?>" <?php echo (int)$article['id_kategorija'] === (int)$category['id_kategorija'] ? 'selected' : ''; ?>>
                            <?php echo e($category['naziv']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit">Spremi promjene</button>
            </form>
        </section>
    <?php endif; ?>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
