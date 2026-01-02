<?php
$require_login = true;
require __DIR__ . '/includes/header.php';
?>
<section>
    <h2>Tableau de bord</h2>
    <p>Bienvenue <?php echo e($_SESSION['username'] ?? ''); ?> — utilisez le menu pour gérer les produits et catégories.</p>
    <ul>
        <li><a href="/projet/crud_principal/list.php">Gérer les produits</a></li>
        <li><a href="/projet/crud_secondaire/list.php">Gérer les catégories</a></li>
    </ul>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
