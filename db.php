<?php
$dbc = mysqli_connect('localhost', 'root', '2332', 'le_nouvel_observateur');

if (!$dbc) {
    die('Greška pri spajanju na bazu: ' . mysqli_connect_error());
}

mysqli_set_charset($dbc, 'utf8mb4');
?>
