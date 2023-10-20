<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeBreaker - Code du jour</title>

    <link rel="stylesheet" href="../style.css">
</head>
<body class="layout-column">

<?php
include_once('../composants/header.php');
include_once('../composants/tabBalls.php');
include_once('../composants/clavier.php');

// Requête SELECT
$dateDuJour = date("Y-m-d");

$query = "SELECT code FROM codeoftheday WHERE date LIKE '" . $dateDuJour . "'";
$result = $conn->query($query);

if ($result->rowCount() > 0) {
    foreach ($result as $row) {
        // Supposons que vous ayez déjà récupéré la valeur de code depuis PHP et l'avez stockée dans $row['code']
        $code = $row['code'];

        // Utilisez json_encode pour générer une chaîne JSON valide
        $codeJSON = json_encode($code);
    }
} else {
    header("location: ../index.php");
}

include_once('../scripts/script.php');
?>

</body>
</html>