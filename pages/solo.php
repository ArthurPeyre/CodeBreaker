<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeBreaker - Montez au sommet du podium !</title>
    
    <link rel="stylesheet" href="../style.css">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    
    <div class="layout-column" id="app">
        
<?php
include_once('../composants/header.php');
if (!isset($_SESSION['ACCOUNT'])) {
    header('location: ./login.php');
}
?>
<?php
// Vérifiez si le score a été envoyé en POST
if (isset($_POST['score'])) {
    // Récupérez le score envoyé en POST
    $score = $_POST['score'];
    
    $sql = "UPDATE users SET score_solo = :score WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':score', $score, PDO::PARAM_INT);
    $stmt->bindParam(':id', $_SESSION['ID'], PDO::PARAM_INT);
    $stmt->execute();
    
    // echo "Score sauvegardé avec succès !"; // Réponse du serveur
}
// else {
//     echo "Aucun score n'a été envoyé.";
// }
?>
<div class="layout-column" style="gap: 5px;">
<div class="layout-row" style="justify-content: space-between;">
    <span id="numCode" style="color: #fff; font-weight: 600;">Code 1</span>
    <span id="score" style="color: #fff; font-weight: 600;">0 Score</span>
</div>
<?php
include_once('../composants/tabBalls.php')
?>
</div>
<?php
include_once('../composants/clavier.php');
include_once('../scripts/script.php');
?>

    </div>

</body>
</html>