<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour récupérer tous les utilisateurs
    public function getAllUsers() {
        $query = "SELECT * FROM users";
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour créer un nouvel utilisateur
    public function createUser($username, $password, $email) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $hashedPassword = $password;


        $query = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $hashedPassword);
        $statement->bindParam(':email', $email);
        $statement->execute();

        return $this->pdo->lastInsertId();
    }

    // Méthode pour récupérer un utilisateur par son nom d'utilisateur
    public function getUserByUsername($username) {
        $query = "SELECT * FROM users WHERE username = :username";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
