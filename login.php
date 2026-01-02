<?php
require __DIR__ . '/config/database.php';
session_start();

/**
 * Création automatique d’un admin si la table users est vide
 * (à utiliser idéalement une seule fois)
 */
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        $hash = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare(
            "INSERT INTO users (username, password) VALUES (?, ?)"
        );
        $stmt->execute(['admin', $hash]);
    }
} catch (Exception $e) {
    // Ignore si la table n’existe pas
}

$error = '';

/**
 * Traitement du formulaire
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Veuillez fournir vos identifiants.';
    } else {
        $stmt = $pdo->prepare(
            "SELECT id, username, password FROM users WHERE username = ? LIMIT 1"
        );
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Connexion réussie
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_in'] = true;

            header('Location: /projet/dashboard.php');
            exit;
        } else {
            $error = 'Identifiant ou mot de passe incorrect.';
        }
    }
}

require __DIR__ . '/includes/header.php';
?>

<section>
    <h2>Connexion</h2>

    <?php if ($error): ?>
        <p class="error"><?php echo e($error); ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label>
            Nom d'utilisateur<br>
            <input type="text" name="username"
                   value="<?php echo e($_POST['username'] ?? ''); ?>">
        </label>

        <label>
            Mot de passe<br>
            <input type="password" name="password">
        </label>

        <button type="submit" class="btn">Se connecter</button>
    </form>

    <p>
        Compte administrateur par défaut :
        <strong>admin</strong> /
        <strong>admin123</strong>
        (à changer après la première connexion)
    </p>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
