<?php
require_once __DIR__ . '/../config/database.php';
session_start();

$id = $_GET['id'] ?? null;
if (!$id) { header('Location: /projet/crud_secondaire/list.php'); exit; }

// Empêcher suppression si des produits sont liés (option sécurisée)
$stmt = $pdo->prepare('SELECT COUNT(*) FROM products WHERE category_id = ?');
$stmt->execute([$id]);
if ($stmt->fetchColumn() > 0) {
    $_SESSION['error'] = 'Impossible de supprimer : des produits utilisent cette catégorie.';
    header('Location: /projet/crud_secondaire/list.php'); exit;
}

$pdo->prepare('DELETE FROM categories WHERE id = ?')->execute([$id]);
$_SESSION['success'] = 'Catégorie supprimée.';
header('Location: /projet/crud_secondaire/list.php'); exit;
