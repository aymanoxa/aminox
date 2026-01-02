<?php
$require_login = true;
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/header.php';

// Lecture des produits avec nom de catégorie
$stmt = $pdo->query('SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC');
$products = $stmt->fetchAll();
?>
<section>
    <h2>Liste des produits</h2>
    <p><a class="btn" href="/projet/crud_principal/add.php">Ajouter un produit</a></p>
    <table>
        <thead>
            <tr><th>ID</th><th>Nom</th><th>Prix</th><th>Quantité</th><th>Catégorie</th><th>Actions</th></tr>
        </thead>
        <tbody>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?php echo e($p['id']); ?></td>
                <td><?php echo e($p['name']); ?></td>
                <td><?php echo e($p['price']); ?> €</td>
                <td><?php echo e($p['quantity']); ?></td>
                <td><?php echo e($p['category_name']); ?></td>
                <td>
                    <a href="/projet/crud_principal/edit.php?id=<?php echo $p['id']; ?>">Modifier</a>
                    |
                    <a href="/projet/crud_principal/delete.php?id=<?php echo $p['id']; ?>" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
