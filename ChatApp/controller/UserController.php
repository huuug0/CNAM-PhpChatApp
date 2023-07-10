<?php

require_once '../../config/database.php';


class UserController {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;}

    public function register(){
// Vérifier si le formulaire d'inscription a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    // Récupérer les valeurs du formulaire d'inscription
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['mail'];

    // Hash du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $hashedPassword = $password;


    // Requêter la base de données pour créer un nouvel utilisateur
    $query = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':email', $email);

    if ($stmt->execute()) {
        // L'utilisateur a été créé avec succès
        echo "L'utilisateur a été créé avec succès.";
        header('Location: ../../index.php');
        exit();
    } else {
        // La création de l'utilisateur a échoué
        echo "La création de l'utilisateur a échoué.";
        header('Location: register.php?error=1');
        exit();
    }
}
}



public function isconnected(){
// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    // L'utilisateur est déjà connecté, rediriger vers la page protégée
    header('Location: ../../index.php');
    exit();
}
}

public function issubmit(){

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    // Récupérer les valeurs du formulaire de connexion
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Requêter la base de données pour vérifier la correspondance des informations
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($user);

    // Vérifier si l'utilisateur existe
    if ($user) {
        // Vérifier si le mot de passe correspond
        if ($password === $user['password']) {
            // L'utilisateur est connecté avec succès
            // Stocker l'ID de l'utilisateur dans la session
            $_SESSION['user_id'] = $user['id'];

            // Rediriger vers une page protégée
            header('Location: ../../index.php');
            exit();
        } else {
            // La connexion a échoué
            echo "<script>alert('Mot de passe incorrect');</script>";
        }
    } else {
        // La connexion a échoué
        echo "<script>alert('Identifiant incorrect');</script>";
    }
}
}
public function allusers(){
//récupérer tous les utilisateurs
$query = "SELECT * FROM users";
$stmt = $this->conn->prepare($query);
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $users;

}
}