<?php
session_start();
require 'db.php';
require 'functions.php';
requireAdmin();
$categoriesForMenu = fetchCategories($dbc);

$query = "SELECT v.id_vijest, v.naslov, v.datum_objave, k.naziv AS kategorija, a.ime, a.prezime
          FROM vijesti v
          INNER JOIN kategorije k ON v.id_kategorija = k.id_kategorija
          INNER JOIN admini a ON v.id_admin = a.id_admin
          ORDER BY v.datum_objave DESC";
$result = mysqli_query($dbc, $query);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator - Le Nouvel Observateur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,500..900;1,6..96,500..900&family=Libre+Baskerville:wght@400;700&family=Inter:wght@500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css?v=2">
</head>
<body>
<?php include 'header.php'; ?>
<main class="admin-page container">
    <div class="admin-heading">
        <div>
            <h2>Administracija</h2>
            <p>Prijavljeni ste kao <?php echo e($_SESSION['admin_name']); ?>.</p>
        </div>
        <a class="black-button" href="unos.php">Dodaj vijest</a>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Naslov</th>
                    <th>Kategorija</th>
                    <th>Datum</th>
                    <th>Autor</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo e($row['naslov']); ?></td>
                        <td><?php echo e($row['kategorija']); ?></td>
                        <td><?php echo formatDateHr($row['datum_objave']); ?></td>
                        <td><?php echo e($row['ime'] . ' ' . $row['prezime']); ?></td>
                        <td class="admin-actions">
                            <a href="clanak.php?id=<?php echo (int)$row['id_vijest']; ?>">Prikaži</a>
                            <a href="uredi.php?id=<?php echo (int)$row['id_vijest']; ?>">Uredi</a>
                            <a class="danger" href="brisi.php?id=<?php echo (int)$row['id_vijest']; ?>" onclick="return confirm('Želite li obrisati vijest?');">Obriši</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>
<a class="floating-add" href="unos.php" aria-label="Dodaj vijest">+</a>
<?php include 'footer.php'; ?>
</body>
</html>
