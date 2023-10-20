<?php
include_once('conn.php');
include_once('./scripts/random.php');

// Données à insérer
$date = date("Y-m-d");
$code = "";

do {
    // Générer une nouvelle combinaison de code
    $code = randomCombination();

    // Requête SELECT
    $query = "SELECT * FROM codeoftheday WHERE date = :laDate OR code = :code";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':laDate', $date, PDO::PARAM_STR);
    $stmt->bindParam(':code', $code, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} while(count($result) > 0);

// Requête INSERT avec des paramètres liés
$sql = "INSERT INTO codeoftheday (code, date) VALUES (:code, :laDate)";
$requete = $conn->prepare($sql);

// Lier les valeurs des paramètres
$requete->bindParam(':code', $code, PDO::PARAM_STR);
$requete->bindParam(':laDate', $date, PDO::PARAM_STR);

// Exécuter la requête
$requete->execute();

echo "Nouvel enregistrement inséré avec succès.";
?>
