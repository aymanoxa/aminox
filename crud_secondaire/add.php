<?php
$require_login = true;
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/header.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    if ($name === '') $errors[] = 'Le nom est requis.';
    if (empty($errors)) {
        try {
            $pdo->prepare('INSERT INTO categories (name) VALUES (?)')->execute([$name]);
            $_SESSION['success'] = 'Catégorie ajoutée.';
            header('Location: /projet/crud_secondaire/list.php'); exit;
        } catch (PDOException $e) {
            $errors[] = 'Erreur : ' . e($e->getMessage());
        }
    }
}
?>
<section>
    <h2>Ajouter une catégorie</h2>
    <?php if (!empty($errors)): ?><div class="error"><?php echo e(implode('<br>', $errors)); ?></div><?php endif; ?>
    <form method="post">
        <label>Nom<br><input type="text" name="name" value="<?php echo e($_POST['name'] ?? ''); ?>"></label>
        <button class="btn" type="submit">Ajouter</button>
    </form>
    <p><a href="/projet/crud_secondaire/list.php">Retour</a></p>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
