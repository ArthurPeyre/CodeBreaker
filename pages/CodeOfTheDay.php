<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeBreaker - Code du jour</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="icon" type="image/x-icon" href="https://ayico.fr/images/logo/logo.ico">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="layout-column" id="app">
        <?php
include_once('../composants/header.php');
if (!isset($_SESSION['ACCOUNT'])) {
    header('location: ./login.php');
}else {
    $requete = $conn->prepare("SELECT codeoftheday FROM users WHERE id = :id");
    
    $requete->bindParam(':id', $_SESSION['ACCOUNT'], PDO::PARAM_INT);
    
    if ($requete->execute()) {
        $row = $requete->fetch();
        
        if (!empty($row) && $row['codeoftheday'] != 0) {
            // Si le code du jour est déja trouvé...
?>
        <div class="layout-column">
<?php
            if ($row['codeoftheday'] ==1 ) {
?>
            <p style="color: #fff; text-align:center;">C'est gagné pour aujourd'hui !</p>
<?php
            }else {
?>
            <p style="color: #fff; text-align:center;">C'est perdu pour aujourd'hui !</p>
<?php
            }
?>
        </div>
<?php
include_once('../composants/share_follow.php');

        }
        else {
            // Sinon...
            
            // Vérifiez si le code a été envoyé en POST
            if (isset($_POST['code'])) {
                $code = $_POST['code'];
                
                $sql = "UPDATE users SET codeoftheday = :code WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':code', $code, PDO::PARAM_INT);
                $stmt->bindParam(':id', $_SESSION['ACCOUNT'], PDO::PARAM_INT);
                $stmt->execute();
                
                // echo "Score sauvegardé avec succès !"; // Réponse du serveur
                
                header('location: ../index.php');
            }
            
            // Requête SELECT
            $dateDuJour = date("Y-m-d");
            
            $query = "SELECT code FROM codeoftheday WHERE date LIKE '" . $dateDuJour . "'";
            $result = $conn->query($query);
            
            if ($result->rowCount() > 0) {
                foreach ($result as $row) {
                    $code = $row['code'];

                    // Utilisez json_encode pour générer une chaîne JSON valide
                    $codeJSON = json_encode($code);
                }
            } else {
                header("location: ../index.php");
                exit;
            }

            include_once('../composants/tabBalls.php');
            include_once('../composants/clavier.php');

        }
    }
}
?>

</div>

<script>
    var tabResult = <?= $codeJSON ?>;
    tabResult = tabResult.split(",");
    
    console.log(tabResult);
    
    
    var tabColor = [[],[],[],[]];
    var rounds = 1;

    function addColor(color) {
        if (tabColor[rounds - 1].length < 4) {
            tabColor[rounds-1].push(color);
            
            ball = document.querySelectorAll("#round-" + rounds + " .ball circle")[tabColor[rounds - 1].length - 1];
            path = document.querySelectorAll("#round-" + rounds + " .ball path")[tabColor[rounds - 1].length - 1].style.fill = "rgba(0,0,0,0.25)";
            
            switch (color) {
                case 'red':
                    ball.style.fill = "#BE0F0F";
                    break;
                    
                case 'green':
                    ball.style.fill = "#0FBE0F";
                    break;
                    
                case 'blue':
                    ball.style.fill = "#1010EE";
                    break;
                    
                case 'yellow':
                    ball.style.fill = "#E3E327";
                    break;
                    
                case 'white':
                    ball.style.fill = "#DDDDDD";
                    break;
                    
                case 'black':
                    ball.style.fill = "#333333";
                    break;
                    
                default:
                    break;
                }
            }
    }

    function delColor() {
        if (tabColor[rounds - 1].length > 0) {
            ball = document.querySelectorAll("#round-" + rounds + " .ball circle")[tabColor[rounds - 1].length - 1].style.fill = "transparent";
            path = document.querySelectorAll("#round-" + rounds + " .ball path")[tabColor[rounds - 1].length - 1].style.fill = "transparent";
            
            tabColor[rounds - 1].splice(tabColor[rounds - 1].length-1,1);
        }
    }

    function checkColor() {
        if (tabColor[rounds - 1].length === 4) {
            var verifyColor = [0,0,0,0];
            var verifyFalseColor = [0,0,0,0];
            
            for (var i = 0; i < verifyColor.length; i++) {
                if (tabColor[rounds - 1][i] === tabResult[i]) {
                    verifyColor[i] = 1;
                    var span = document.querySelectorAll("#round-" + rounds + " span")[i];
                    span.classList.add('green');
                }
            }
            
            if (verifyColor.includes(0)) {
                for (i = 0; i<verifyColor.length; i++) {
                    if (verifyColor[i] === 0) {
                        for (j = 0; j<tabResult.length; j++) {
                            if (i !== j && verifyColor[j] === 0 && verifyFalseColor[j] === 0 && tabResult[j] === tabColor[rounds - 1][i]) {
                                var span = document.querySelectorAll("#round-" + rounds + " span")[i];
                                span.classList.add('orange');
                                verifyFalseColor[j] = 1;
                            }
                        }
                    }
                }
            }

            for (i=0; i<tabResult.length; i++) {
                var isIn = false;
                for (j=0; j<tabResult.length; j++) {
                    if (tabResult[j] === tabColor[rounds - 1][i]) {
                        isIn = true;
                    }
                }
                if (!(isIn)) {
                    var btn = document.querySelectorAll("#" + tabColor[rounds - 1][i]);
                    btn[0].classList.add("disable");
                }
            }

            if (JSON.stringify(tabResult) === JSON.stringify(tabColor[rounds - 1])) {
                // Le joueur a gagné
                alert("Bravo, vous avez trouvé la combinaison secrète !");

                var data = {
                    code: 1
                };

                // Effectuez la requête AJAX
                $.ajax({
                    type: "POST", // Utilisez la méthode POST pour envoyer les données
                    url: "../pages/CodeOfTheDay.php", // Spécifiez l'URL du script PHP côté serveur
                    data: data, // Envoyez les données JSON
                    success: function(response) {
                        // La requête AJAX a réussi, et vous pouvez gérer la réponse du serveur ici
                        console.log("Score sauvegardé avec succès !");
                    },
                    error: function(xhr, status, error) {
                        // En cas d'erreur, vous pouvez gérer l'erreur ici
                        console.error("Erreur lors de la sauvegarde du score : " + error);
                    }
                });

            } else if (rounds === 4) {
                // Le joueur a épuisé ses tentatives, il a perdu
                alert("Vous avez épuisé vos tentatives. La combinaison secrète était : " + tabResult.join(' '));

                var data = {
                    code: 2
                };

                // Effectuez la requête AJAX
                $.ajax({
                    type: "POST", // Utilisez la méthode POST pour envoyer les données
                    url: "../pages/CodeOfTheDay.php", // Spécifiez l'URL du script PHP côté serveur
                    data: data, // Envoyez les données JSON
                    success: function(response) {
                        // La requête AJAX a réussi, et vous pouvez gérer la réponse du serveur ici
                        console.log("Score sauvegardé avec succès !");
                    },
                    error: function(xhr, status, error) {
                        // En cas d'erreur, vous pouvez gérer l'erreur ici
                        console.error("Erreur lors de la sauvegarde du score : " + error);
                    }
                });
            } else {
                // Passer à la prochaine manche
                rounds++;
            }
        }
    }
</script>

</body>
</html>