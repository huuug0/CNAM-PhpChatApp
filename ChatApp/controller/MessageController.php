<?php

require_once '../../config/database.php';


class MessageController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;}

    public function getMessageEnvoyés(){
    //récupérer les messages envoyé par l'user connecté
$query = "SELECT * FROM messages WHERE messages.envoyeur = :user_id";
$stmt = $this->conn->prepare($query);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();

// Récupération des résultats de la requête dans un tableau d'objets Message
$messages = $stmt->fetchAll(PDO::FETCH_OBJ);

return $messages;

}

public function getMessageReçus(){

    //récupérer les messages reçu par l'user connecté
$query = "SELECT * FROM messages WHERE messages.destinataire = :user_id";
$stmt = $this->conn->prepare($query);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();

// Récupération des résultats de la requête dans un tableau d'objets Message
$messages = $stmt->fetchAll(PDO::FETCH_OBJ);

return $messages;
}

public function createNewMessage($conn){
// Vérifier si le formulaire de création a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $content = $_POST['content'];
    $destinataireId = $_POST['user_id'];
    $envoyeurId = $_POST['envoyeur_id'];

    // Créer un nouvel objet Message
    $message = new MessageModel($conn);

    // Renseigner le destinataire et l'envoyeur du message
    $message->setDestinataire($destinataireId);
    $message->setEnvoyeur($envoyeurId);
    $message->setContent($content);

    // Récupérer la liste des utilisateurs de la base de données
    $query = "SELECT * FROM users";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);



    // Enregistrer le message dans la base de données
    if ($message->save()) {
        // Rediriger vers la page des messages avec un message de succès
        header('Location: listeMessageEnvoyé.php?success=1');
        exit();
    } else {
        // Rediriger vers la page des messages avec un message d'erreur
        header('Location: listeMessageEnvoyé.php?error=1');
        exit();
    }
}}
public function allusers(){

// Récupérer la liste des utilisateurs
$query = "SELECT * FROM users";
$stmt = $this->conn->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

return $users;
}
}
