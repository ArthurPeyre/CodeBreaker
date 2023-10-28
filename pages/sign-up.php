<?php
include_once('../conn.php');

if (isset($_SESSION['ACCOUNT'])) {
    header('location: ../index.php');
}

if (isset($_POST['txtname']) && isset($_POST['txtpw'])) {
    $requete = $conn->prepare("SELECT id FROM users WHERE username = :username");
    
    $requete->bindParam(':username', $_POST['txtname'], PDO::PARAM_STR);
    
    if ($requete->execute()) {
        $row = $requete->fetch();
        
        if (empty($row)) {
            $password = password_hash($_POST['txtpw'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO users VALUES (NULL, :username, :password, 0)";
            $requete = $conn->prepare($sql);

            $requete->bindParam(':username', $_POST['txtname'], PDO::PARAM_STR);
            $requete->bindParam(':password', $password, PDO::PARAM_STR);

            $requete->execute();
        } else {
            $error = "Le nom d'utilisateur est déjà utilisé...";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeBreaker - Sign-up</title>

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
            <input type="submit" class="btn-long" value="Créer un compte" style="justify-content:center;">
        </form>

        <div class="layout-column">
            <a href="./login.php" class="btn-long" style="justify-content:center;">Se connecter</a>
        </div>
    </div>

</body>
</html>
