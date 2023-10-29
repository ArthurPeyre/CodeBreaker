<?php
include_once('../conn.php');

if (isset($_SESSION['ACCOUNT'])) {
    header('location: ../index.php');
}

if (isset($_POST['txtname']) && isset($_POST['txtpw'])) {
    $requete = $conn->prepare("SELECT id, password FROM users WHERE username = :username");
    
    $requete->bindParam(':username', $_POST['txtname'], PDO::PARAM_STR);
    
    if ($requete->execute()) {
        $row = $requete->fetch();
        
        if (!empty($row) && password_verify($_POST['txtpw'], $row['password'])) {
            $_SESSION['ACCOUNT'] = $row['id'];
            header("location: ../index.php");
        } else {
            $error = "Le nom d'utilisateur ou le mot de passe sont invalides...";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeBreaker - Login</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="icon" type="image/x-icon" href="https://ayico.fr/images/logo/logo.ico">
</head>
<body>

    <div class="layout-column" id="app" style="justify-content: start;">
        <header>
            <h1>CodeBreaker</h1>
        </header>
    
        <form action="" method="post" class="layout-column" style="margin: auto 0;">
            <?= $error ?>
            <input type="text" name="txtname" class="container" placeholder="Username">
            <input type="password" name="txtpw" class="container" placeholder="Password">
            <input type="submit" value="Se connecter" class="btn-long" style="justify-content:center;">
        </form>

        <div class="layout-column">
            <a href="./sign-up.php" class="btn-long" style="justify-content:center;">Créer un compte</a>
        </div>
    </div>

    
</body>
</html>