<?php
session_start();
require 'db.php';
require 'functions.php';
requireAdmin();
$categoriesForMenu = fetchCategories($dbc);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos vijesti - Le Nouvel Observateur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,500..900;1,6..96,500..900&family=Libre+Baskerville:wght@400;700&family=Inter:wght@500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css?v=2">
</head>
<body>
<?php include 'header.php'; ?>
<main class="form-page container">
    <section class="form-section">
        <h2>Unos nove vijesti</h2>
        <p>Dodajte naslov, sažetak, tekst članka, kategoriju i naziv slike koja se nalazi u mapi <strong>images</strong>.</p>
        <form class="form-box" name="unosVijesti" method="POST" action="skripta.php" enctype="multipart/form-data">
            <label for="naslov">Naslov vijesti</label>
            <input type="text" id="naslov" name="naslov" required>

            <label for="sazetak">Kratki sažetak</label>
            <textarea id="sazetak" name="sazetak" rows="4" required></textarea>

            <label for="tekst">Tekst vijesti</label>
            <textarea id="tekst" name="tekst" rows="12" required></textarea>

            <label for="id_kategorija">Kategorija</label>
            <select id="id_kategorija" name="id_kategorija" required>
                <?php foreach ($categoriesForMenu as $category): ?>
                    <option value="<?php echo (int)$category['id_kategorija']; ?>"><?php echo e($category['naziv']); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="slika">Slika</label>
            <input type="file" id="slika" name="slika" accept="image/*">
            <p class="form-note">Ako ne odabereš sliku, koristi se zadana slika za kategoriju.</p>

            <button type="submit">Spremi vijest</button>
        </form>
    </section>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
