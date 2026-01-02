<?php
require_once __DIR__ . '/../config/database.php';
session_start();

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: /projet/crud_principal/list.php'); exit;
}

$stmt = $pdo->prepare('DELETE FROM products WHERE id = ?');
$stmt->execute([$id]);
$_SESSION['success'] = 'Produit supprimé.';
header('Location: /projet/crud_principal/list.php');
exit;
