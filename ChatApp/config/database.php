<?php

$dbHost = 'localhost';
$dbName = 'chatapp';
$dbUser = 'root';
$dbPass = '';

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion à la base de données établie avec succès." . PHP_EOL;
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage() . PHP_EOL;
    die();
}

// Création des tables
try {
    $conn->exec("
        CREATE TABLE IF NOT EXISTS messages (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            conversation_id INT(11) UNSIGNED NOT NULL,
            content TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (conversation_id) REFERENCES conversations(id) ON DELETE CASCADE
        );
    ");
    $conn->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
    ");
    echo "Tables créées avec succès." . PHP_EOL;
} catch (PDOException $e) {
    echo "Erreur lors de la création des tables: " . $e->getMessage() . PHP_EOL;
    die();
}

// // Remplissage des tables avec des données fictives
// try {
//     // Insertion de conversations
//     $conn->exec("INSERT INTO conversations (title) VALUES
//         ('Conversation 1'),
//         ('Conversation 2'),
//         ('Conversation 3')
//     ");
    
//     // Insertion de messages
//     $conn->exec("INSERT INTO messages (conversation_id, content) VALUES
//         (1, 'Message 1 de la conversation 1'),
//         (1, 'Message 2 de la conversation 1'),
//         (2, 'Message 1 de la conversation 2'),
//         (2, 'Message 2 de la conversation 2'),
//         (3, 'Message 1 de la conversation 3')
//     ");
    
//     // Insertion d'utilisateurs
//     $conn->exec("INSERT INTO users (username, email) VALUES
//         ('Utilisateur 1', 'utilisateur1@example.com'),
//         ('Utilisateur 2', 'utilisateur2@example.com'),
//         ('Utilisateur 3', 'utilisateur3@example.com')
//     ");

//     echo "Données insérées avec succès." . PHP_EOL;
// } catch (PDOException $e) {
//     echo "Erreur lors de l'insertion des données: " . $e->getMessage() . PHP_EOL;
//     die();
// }
