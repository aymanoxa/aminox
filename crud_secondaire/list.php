<?php
$require_login = true;
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/header.php';

$cats = $pdo->query('SELECT * FROM categories ORDER BY name')->fetchAll();
?>
<section>
    <h2>Liste des catégories</h2>
    <p><a class="btn" href="/projet/crud_secondaire/add.php">Ajouter une catégorie</a></p>
    <table>
        <thead><tr><th>ID</th><th>Nom</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach ($cats as $c): ?>
            <tr>
                <td><?php echo e($c['id']); ?></td>
                <td><?php echo e($c['name']); ?></td>
                <td>
                    <a href="/projet/crud_secondaire/delete.php?id=<?php echo $c['id']; ?>" onclick="return confirm('Supprimer cette catégorie ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
