
<?php
session_start();
require 'db.php';
require 'functions.php';
$categoriesForMenu = fetchCategories($dbc);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['korisnicko_ime'] ?? '');
    $password = $_POST['lozinka'] ?? '';

    $stmt = mysqli_prepare($dbc, "SELECT id_admin, ime, prezime, korisnicko_ime, lozinka FROM admini WHERE korisnicko_ime = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && (password_verify($password, $admin['lozinka']) || hash_equals($admin['lozinka'], $password))) {
        $_SESSION['admin_id'] = $admin['id_admin'];
        $_SESSION['admin_name'] = $admin['ime'] . ' ' . $admin['prezime'];
        header('Location: administrator.php');
        exit;
    }

    $error = 'Neispravno korisničko ime ili lozinka.';
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija - Le Nouvel Observateur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,500..900;1,6..96,500..900&family=Libre+Baskerville:wght@400;700&family=Inter:wght@500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css?v=2">
</head>
<body>
<?php include 'header.php'; ?>
<main class="form-page container">
    <section class="admin-card">
        <h2>Prijava administratora</h2>
        <p>Administracijski dio namijenjen je urednicima portala.</p>
        <?php if ($error): ?><p class="message error"><?php echo e($error); ?></p><?php endif; ?>
        <form method="POST" action="admin-login.php" class="form-box">
            <label for="korisnicko_ime">Korisničko ime</label>
            <input type="text" id="korisnicko_ime" name="korisnicko_ime" required autofocus>

            <label for="lozinka">Lozinka</label>
            <input type="password" id="lozinka" name="lozinka" required>

            <button type="submit">Prijavi se</button>
        </form>
    </section>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
