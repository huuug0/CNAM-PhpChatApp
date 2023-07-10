<?php
session_start();

// Vérifier si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user_id'])) {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: views/users/login.php');
    exit();
}

// Traitement de la déconnexion
if (isset($_GET['logout'])) {
    // Supprimer la session et rediriger vers la page de connexion
    session_destroy();
    header('Location: views/users/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page d'accueil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        ul {
            list-style-type: none;
            margin: 20px;
            padding: 0;
        }

        li {
            display: inline-block;
            margin-right: 10px;
            position: relative;
        }

        li a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            background-color: #f1f1f1;
            border-radius: 5px;
        }

        li a:hover {
            background-color: #ccc;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            display: block;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenue sur la page d'accueil</h1>
    </header>

    <ul>
        <li class="dropdown">
            <a href="#">Messages</a>
            <div class="dropdown-content">
                <a href="<?php echo isset($_SESSION['user_id']) ? 'views/messages/listeMessageReçu.php' : '#'; ?>">Messages reçus</a>
                <a href="<?php echo isset($_SESSION['user_id']) ? 'views/messages/listeMessageEnvoyé.php' : '#'; ?>">Messages envoyés</a>
                <a href="<?php echo isset($_SESSION['user_id']) ? 'views/messages/create.php' : '#'; ?>">Créer un message</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Utilisateurs</a>
            <div class="dropdown-content">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="?logout=1">Déconnexion</a>
                <?php else: ?>
                    <a href="views/users/login.php">Connexion</a>
                    <a href="views/users/register.php">Créer un compte</a>
                <?php endif; ?>
                <a href="<?php echo isset($_SESSION['user_id']) ? 'views/users/listeUsers.php' : '#'; ?>">Voir les utilisateurs</a>
            </div>
        </li>
    </ul>
</body>
</html>
