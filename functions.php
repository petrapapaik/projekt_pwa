<?php
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function categoryKey($name) {
    $map = array(
        'Politika' => 'politika',
        'Sport' => 'sport',
        'Glazba' => 'glazba',
        'Umjetnost' => 'umjetnost',
        'Tehnologija' => 'tehnologija'
    );
    return $map[$name] ?? strtolower($name);
}

function categoryNameFromKey($key) {
    $map = array(
        'politika' => 'Politika',
        'sport' => 'Sport',
        'glazba' => 'Glazba',
        'umjetnost' => 'Umjetnost',
        'tehnologija' => 'Tehnologija'
    );
    return $map[$key] ?? 'Politika';
}

function formatDateHr($date) {
    return date('d.m.Y. H:i', strtotime($date));
}

function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function requireAdmin() {
    if (!isAdminLoggedIn()) {
        header('Location: admin-login.php');
        exit;
    }
}

function fetchCategories($dbc) {
    $categories = array();
    $query = "SELECT id_kategorija, naziv FROM kategorije ORDER BY id_kategorija ASC";
    $result = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    return $categories;
}
?>
