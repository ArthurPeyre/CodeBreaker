<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeBreaker - Résultats</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="icon" type="image/x-icon" href="https://ayico.fr/images/logo/logo.ico">
</head>
<body class="layout-column">

<?php
include_once('../composants/header.php');

// Requête SELECT
$query = "SELECT * FROM codeoftheday";
$result = $conn->query($query);

?>

</body>
</html>