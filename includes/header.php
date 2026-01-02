<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) session_start();
// Charger la configuration (connexion + helpers) pour que la fonction e() soit disponible
require_once __DIR__ . '/../config/database.php';
// Protection de pages : si la page définit $require_login = true, on vérifie la session
if (isset($require_login) && $require_login === true) {
    if (empty($_SESSION['user_id'])) {
        header('Location: /projet/login.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Gestion de stock</title>
    <link rel="stylesheet" href="/projet/css/style.css">
</head>
<body>
<header>
    <h1>Gestion de stock</h1>
    <nav>
        <a href="/projet/index.php">Accueil</a>
        <?php if (!empty($_SESSION['user_id'])): ?>
            <a href="/projet/dashboard.php">Dashboard</a>
            <a href="/projet/crud_principal/list.php">Produits</a>
            <a href="/projet/crud_secondaire/list.php">Catégories</a>
            <a href="/projet/logout.php">Déconnexion</a>
        <?php else: ?>
            <a href="/projet/login.php">Connexion</a>
        <?php endif; ?>
    </nav>
</header>
<main>
