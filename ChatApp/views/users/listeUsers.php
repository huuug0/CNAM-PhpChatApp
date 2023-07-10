<?php
require_once '../../config/database.php';
require_once '../../controller/UserController.php';


$userController = new UserController($conn);
$users = $userController->allusers();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Liste des utilisateurs</title>
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
      list-style-type: none;
      padding: 0;
    }

    li {
      margin-bottom: 10px;
      background-color: #f9f9f9;
      padding: 10px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <h1>Liste des utilisateurs</h1>
  <ul>
    <?php foreach ($users as $user): ?>
      <li>
        <strong>Nom d'utilisateur:</strong> <?php echo $user['username']; ?><br>
        <strong>Email:</strong> <?php echo $user['email']; ?>
      </li>
    <?php endforeach; ?>
  </ul>
  <a href="../../index.php" class="btn">Retour à l'accueil</a>
</body>
</html>
