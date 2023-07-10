J'ai crée cet ChattApp qui commprend une page de connexion et de création de compte.
On ne peux pas aller plus loin dans l'application si on est pas identifié, une fois connecté on peut choisir de :
    -voir la liste des utilisateurs
    -voir la liste des messages reçus 
    -voir la liste des messages envoyés
    -envoyé un nouveau message en renseignant un destinataire, un envoyeur et le message
J'ai essayé de suivre l'architecture MVC au maximum
J'ai egalement essayé de hasher les mots de passes dans la base de données afin qu'on ne les retrouvent pas en clair
J'ai un fichier database.php qui va servir a la connexion a la base de donnée mais qui va aussi creer et remplir les tables si elles sont vides ou absentes
