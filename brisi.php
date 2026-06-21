<?php
session_start();
require 'db.php';
require 'functions.php';
requireAdmin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = mysqli_prepare($dbc, "DELETE FROM vijesti WHERE id_vijest = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);

header('Location: administrator.php');
exit;
?>
