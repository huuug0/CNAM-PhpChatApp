<?php
require_once '../../config/database.php';

class MessageModel {
    private $pdo;
    private $content;
    private $destinataire;
    private $envoyeur;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour récupérer tous les messages d'une conversation
    public function getAllMessages() {
        $query = "SELECT * FROM messages";
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour créer un nouveau message dans une conversation
    public function createMessage($content) {
        $query = "INSERT INTO messages (content, destinataire, envoyeur) VALUES (:content, :destinataire, :envoyeur)";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':content', $content);
        $statement->bindParam(':destinataire', $this->destinataire);
        $statement->bindParam(':envoyeur', $this->envoyeur);
        $statement->execute();

        return $this->pdo->lastInsertId();
    }

    public function setDestinataire($destinataire) {
        $this->destinataire = $destinataire;
    }

    public function setEnvoyeur($envoyeur) {
        $this->envoyeur = $envoyeur;
    }

    public function save() {
        if (empty($this->content) || empty($this->destinataire) || empty($this->envoyeur)) {
            return false; 
            // Les informations du message sont incomplètes
        }

        $query = "INSERT INTO messages (content, destinataire, envoyeur) VALUES (:content, :destinataire, :envoyeur)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':destinataire', $this->destinataire);
        $stmt->bindParam(':envoyeur', $this->envoyeur);

        if ($stmt->execute()) {
            return true; // Enregistrement réussi
        } else {
            return false; // Échec de l'enregistrement
        }
    }

    public function setContent($content) {
        $this->content = $content;
    }
}
