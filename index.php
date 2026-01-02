<?php
require __DIR__ . '/includes/header.php';
?>
<title>your progect</title>

<section>
    <h2>Bienvenue sur l'application de gestion de stock</h2>
    <p>Cette application pédagogique a été conçue pour vous permettre d'apprendre à développer un site web complet en PHP et MySQL.</p>
    <p>Vous pourrez gérer une entité principale — les <strong>produits</strong> — et une entité secondaire — les <strong>catégories</strong>. Le projet couvre l'authentification, la gestion des sessions, et les opérations CRUD (Créer, Lire, Mettre à jour, Supprimer).</p>
    <p class="lead">Fonctionnalités principales :</p>
    <ul>
        <li>Authentification (connexion / déconnexion)</li>
        <li>CRUD complet pour les produits (ajout, modification, suppression, liste)</li>
        <li>CRUD réduit pour les catégories (ajout, suppression, liste)</li>
        <li>Protection des pages internes via sessions</li>
        <li>Validation minimale côté serveur et utilisation de requêtes préparées</li>
    </ul>

    <h3>Menu de navigation</h3>
    <p>Utilisez le menu en haut de la page pour vous connecter, accéder au tableau de bord, gérer les produits et les catégories, ou vous déconnecter.</p>

    <h3>Objectif pédagogique</h3>
    <p>L'objectif est de comprendre et d'implémenter les éléments suivants :</p>
    <ol>
        <li>Conception d'une base de données relationnelle (tables, clés étrangères)</li>
        <li>Connexion à la base via PDO</li>
        <li>Organisation du code avec includes (header/footer, config)</li>
        <li>Gestion des formulaires et validation côté serveur</li>
        <li>Mise en place de sessions pour protéger l'espace interne</li>
    </ol>

    <p><a class="btn" href="/projet/login.php">Se connecter</a></p>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
