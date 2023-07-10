<?php

require_once '../../config/database.php';
require_once '../../Models/MessageModel.php';
require_once '../../controller/MessageController.php';

session_start();


$messageController = new MessageController($conn);
$messages = $messageController->getMessageEnvoyés();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Messages Envoyés</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-size: 16px;
    }

    .btn:hover {
        background-color: #45a049;
    }

        h1 {
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        li {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <h1>Messages Envoyés</h1>
    <ul>
        <?php foreach ($messages as $message): ?>
            <li><?php echo $message->content; ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="../../index.php" class="btn">Retour à l'accueil</a>
</body>
</html>
