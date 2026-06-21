<?php
session_start();
require 'db.php';
require 'functions.php';
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: unos.php');
    exit;
}

$naslov = trim($_POST['naslov'] ?? '');
$sazetak = trim($_POST['sazetak'] ?? '');
$tekst = trim($_POST['tekst'] ?? '');
$idKategorija = (int)($_POST['id_kategorija'] ?? 0);
$idAdmin = (int)$_SESSION['admin_id'];
$slika = '';

$defaultImages = array(
    1 => 'politika.svg',
    2 => 'sport.svg',
    3 => 'glazba.svg',
    4 => 'umjetnost.svg',
    5 => 'tehnologija.svg'
);
$slika = $defaultImages[$idKategorija] ?? 'novine.svg';

if (isset($_FILES['slika']) && $_FILES['slika']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/images/';
    $originalName = basename($_FILES['slika']['name']);
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp', 'svg');
    if (in_array($extension, $allowed, true)) {
        $newName = uniqid('vijest_', true) . '.' . $extension;
        if (move_uploaded_file($_FILES['slika']['tmp_name'], $uploadDir . $newName)) {
            $slika = $newName;
        }
    }
}

$stmt = mysqli_prepare($dbc, "INSERT INTO vijesti (naslov, sazetak, tekst, slika, id_kategorija, id_admin) VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'ssssii', $naslov, $sazetak, $tekst, $slika, $idKategorija, $idAdmin);
mysqli_stmt_execute($stmt);
$newId = mysqli_insert_id($dbc);

header('Location: clanak.php?id=' . $newId);
exit;
?>
