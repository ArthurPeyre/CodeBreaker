<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeBreaker - Suite du jour</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="icon" type="image/x-icon" href="https://ayico.fr/images/logo/logo.ico">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

    <div id="app" class="layout-column">

        <div class="layout-column" id="app1">
            <?php
            include_once('../composants/header.php');
                        
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
        
            ?>
            <div class="layout-column" style="gap: 5px;">
                <div class="layout-row" style="justify-content: space-between;">
                    <span id="numCode" style="color: #fff; font-weight: 600;">Code 1</span>
                    <div id="timer" style="color: #fff;">0s</div>
                </div>
                <?php
                include_once('../composants/tabBalls.php')
                ?>
            </div>
            <?php
            
            include_once('../composants/clavier.php');
            ?>
        
        </div>

        <div id="app2" class="layout-column" style="display: none;">

            <?php
            include('../composants/header.php');
            ?>

            <p id="text" style="color: #fff;text-align: center;">Bravo ou perdu ca reste a voir...</p>

            <?php
            include('../composants/share_follow.php');
            ?>

        </div>

    </div>

    <script src="../scripts/theGame.js"></script>

    <script>
        var app1 = document.getElementById('app1');
        var app2 = document.getElementById('app2');

        // alert(document.cookie); //Affiche la liste des cookies

        if (getCookieValue("") !== "") {
            app1.style.display = "none";
            app2.style.display = "flex";

            if (getCookieValue("CodeOfTheDay") === "win") {
                document.getElementById("text").innerHTML = "Bravo c'est gagné pour aujourd'hui !";
            } else {
                document.getElementById("text").innerHTML = "Dommage c'est perdu pour aujourd'hui !";
            }
        }


        var leNumCode = 1;
        var numCode = document.getElementById('numCode');

        var tabResult = <?= $codeJSON ?>;
        tabResult = tabResult.split(",");
        var tabColor = [[],[],[],[]];
        var rounds = 1;

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
                    /*if (!(isIn)) {
                        var btn = document.querySelectorAll("#" + tabColor[rounds - 1][i]);
                        btn[0].classList.add("disable");
                    }*/
                }
        
                if (JSON.stringify(tabResult) === JSON.stringify(tabColor[rounds - 1])) {
                    // Le joueur a gagné
                    // alert("Bravo, vous avez trouvé la combinaison secrète !");
        
                    // Enregistrer le Cookie CodeOfTheDay de valeur WIN
                    setCookieExpiresAtMidnight("SuiteOfTheDay", "win");
        
                    // Rafraîchir la page actuelle
                    window.location.reload();
        
                } else if (rounds === 4) {
                    // Le joueur a épuisé ses tentatives, il a perdu
                    // alert("Vous avez épuisé vos tentatives. La combinaison secrète était : " + tabResult.join(' '));
        
                    // Enregistrer le Cookie CodeOfTheDay de valeur LOOSE
                    setCookieExpiresAtMidnight("SuiteOfTheDay", "loose");

                    // Rafraîchir la page actuelle
                    window.location.reload();
                    
                } else {
                    // Passer à la prochaine manche
                    rounds++;
                }
            }
        }
    </script>

    <script>
        var seconds = 0; // Initialiser le compteur de secondes
        var timerDisplay = document.getElementById('timer'); // Récupérer l'élément où afficher le temps
        var minutes = 0; // Initialiser le compteur de minutes

        // Fonction pour mettre à jour le timer
        function updateTimer() {
            seconds++; // Incrémenter le compteur de secondes

            if (seconds >= 60) {
                seconds = 0; // Remettre à zéro les secondes
                minutes++; // Incrémenter le compteur de minutes
            }

            if (minutes > 0) {
                timerDisplay.textContent = minutes + 'm' + seconds + 's'; // Mettre à jour l'affichage avec les minutes
            } else {
                timerDisplay.textContent = seconds + 's'; // Mettre à jour l'affichage sans les minutes
            }
        }

        // Mettre à jour le timer toutes les secondes (1000 millisecondes)
        var timerInterval = setInterval(updateTimer, 1000);
    </script>

</body>
</html>