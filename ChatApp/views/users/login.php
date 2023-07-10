<?php
session_start();
require_once '../../config/database.php';
require_once '../../controller/UserController.php';


$userController = new UserController($conn);
$userController->isconnected();
$userController->issubmit();


?>

<!DOCTYPE html>
<html>
<head>
  <title>Connexion</title>
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
      max-width: 300px;
      margin-top: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      color: #333;
    }

    input[type="text"],
    input[type="password"] {
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
  </style>
</head>
<body>
  <h1>Connexion</h1>
  <form action="login.php" method="POST">
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" name="username" id="username" required>
    <label for="password">Mot de passe:</label>
    <input type="password" name="password" id="password" required>
    <button type="submit">Se connecter</button>
  </form>
  <p>Vous n'avez pas encore de compte ? <a href="register.php">Inscrivez-vous ici</a>.</p>
</body>
</html>
