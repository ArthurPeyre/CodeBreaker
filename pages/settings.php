<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeBreaker - Settings</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="icon" type="image/x-icon" href="https://ayico.fr/images/logo/logo.ico">
</head>
<body>

    <div class="layout-column" id="app">
        <?php
        include_once('../composants/header.php');
        ?>

        <div class="layout-row">
            <div class="container disable">
                <div class="layout-row">
                    <p style="text-wrap: nowrap;">Supprimer les données</p>
                    <div id="delete" onclick="deleteAllCookies()">
                        <?php
                        include_once('../uploads/icons/trash.svg');
                        ?>
                    </div>
                </div>
                <p>Cette action effacera tous vos scores et statistiques sur cet appareil</p>
            </div>
        </div>
        
        <div class="layout-column">
            <a href="https://github.com/ArthurPeyre/CodeBreaker" target="_BLANK" class="btn-long" style="gap: 0px; padding: 0 20px 0 10px;justify-content:center;">
                <span>
                    <?php
                    include_once('../uploads/icons/github.svg');
                    ?>
                </span>
                <p style="text-wrap: nowrap;">Suivez-nous</p>
            </a>
        </div>
    </div>

    <script src="../scripts/theGame.js"></script>
    
</body>
</html>