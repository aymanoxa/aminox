<?php
$require_login = true;
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/header.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: /projet/crud_principal/list.php'); exit;
}

$stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
$stmt->execute([$id]);
$product = $stmt->fetch();
if (!$product) {
    echo '<p>Produit introuvable.</p>'; require __DIR__ . '/../includes/footer.php'; exit;
}

$errors = [];
$cats = $pdo->query('SELECT id,name FROM categories ORDER BY name')->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = $_POST['price'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $category_id = $_POST['category_id'] ?: null;
    $description = trim($_POST['description'] ?? '');

    if ($name === '') $errors[] = 'Le nom est requis.';
    if (!is_numeric($price) || $price < 0) $errors[] = 'Prix invalide.';
    if (!filter_var($quantity, FILTER_VALIDATE_INT) || $quantity < 0) $errors[] = 'Quantité invalide.';

    if (empty($errors)) {
        $stmt = $pdo->prepare('UPDATE products SET name=?, description=?, price=?, quantity=?, category_id=? WHERE id=?');
        $stmt->execute([$name, $description, $price, $quantity, $category_id, $id]);
        $_SESSION['success'] = 'Produit mis à jour.';
        header('Location: /projet/crud_principal/list.php'); exit;
    }
}
?>
<section>
    <h2>Modifier le produit</h2>
    <?php if (!empty($errors)): ?>
        <div class="error"><?php echo e(implode('<br>', $errors)); ?></div>
    <?php endif; ?>
    <form method="post">
        <label>Nom<br><input type="text" name="name" value="<?php echo e($_POST['name'] ?? $product['name']); ?>"></label>
        <label>Description<br><textarea name="description"><?php echo e($_POST['description'] ?? $product['description']); ?></textarea></label>
        <label>Prix (€)<br><input type="text" name="price" value="<?php echo e($_POST['price'] ?? $product['price']); ?>"></label>
        <label>Quantité<br><input type="number" name="quantity" value="<?php echo e($_POST['quantity'] ?? $product['quantity']); ?>"></label>
        <label>Catégorie<br>
            <select name="category_id">
                <option value="">-- Aucune --</option>
                <?php foreach ($cats as $c): ?>
                    <option value="<?php echo $c['id']; ?>" <?php if (($c['id'] ?? '') == ($_POST['category_id'] ?? $product['category_id'])) echo 'selected'; ?>><?php echo e($c['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <button class="btn" type="submit">Enregistrer</button>
    </form>
    <p><a href="/projet/crud_principal/list.php">Retour à la liste</a></p>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
