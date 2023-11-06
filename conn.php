<?php
$servername = "localhost"; // Adresse du serveur de base de données
$username = "root"; // Nom d'utilisateur de la base de données
$password = "root"; // Mot de passe de la base de données
$database = "codebreaker"; // Nom de la base de données

try {
    // Créer une connexion à la base de données avec PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    // Définir le mode d'erreur de PDO sur Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // À ce stade, vous êtes connecté à la base de données et pouvez exécuter des requêtes SQL
    // Par exemple, pour récupérer des données depuis la base de données, vous pouvez utiliser $conn->query("SELECT * FROM ma_table");

} catch (PDOException $e) {
    echo "La connexion à la base de données a échoué : " . $e->getMessage();
}

$error = "";

// N'oubliez pas de fermer la connexion à la base de données lorsque vous avez terminé
// $conn = null;
?>
