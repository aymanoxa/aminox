<?php
// config/database.php
// Connexion PDO réutilisable
// Ajustez les paramètres ci-dessous selon votre environnement (XAMPP par défaut)

$db_host = '127.0.0.1';
$db_name = 'projet_db';
$db_user = 'root';
$db_pass = '';

try {
	$dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
	$pdo = new PDO($dsn, $db_user, $db_pass, [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	]);
} catch (PDOException $e) {
	// En environnement de développement, afficher l'erreur (sinon journaliser et message générique)
	echo "Erreur de connexion à la base de données : " . htmlspecialchars($e->getMessage());
	exit;
}

// petite fonction helper pour échapper l'affichage HTML
if (!function_exists('e')) {
	function e($str) {
		return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
	}
}

?>
