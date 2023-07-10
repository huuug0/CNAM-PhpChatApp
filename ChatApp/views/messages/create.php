<?php

require_once '../../config/database.php';
require_once '../../Models/MessageModel.php';
require_once '../../controller/MessageController.php';

$messageModel = new MessageModel($conn);
$messageController = new MessageController($conn);
$messages = $messageController->createNewMessage($conn);
$users = $messageController->allusers();




?>

<!DOCTYPE html>
<html>
<head>
    <title>Créer un nouveau message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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
    </style>
</head>
<body>
    <h1>Créer un nouveau message</h1>
    <form method="POST" action="create.php">
        <div>
            <label for="content">Message :</label>
            <textarea name="content" required></textarea>
        </div>
        <div>
            <label for="user_id">Destinataire :</label>
            <select name="user_id">
                <?php foreach ($users as $user) { ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="envoyeur_id">Envoyeur :</label>
            <select name="envoyeur_id">
                <?php foreach ($users as $user) { ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit">Créer</button>
    </form>
    <a href="../../index.php" class="btn">Retour à l'accueil</a>
</body>
</html>
