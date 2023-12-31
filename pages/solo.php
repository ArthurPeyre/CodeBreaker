<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeBreaker - Montez au sommet du podium !</title>
    
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" type="image/x-icon" href="https://ayico.fr/images/logo/logo.ico">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

    <div id="app" class="layout-column">
        
        <div class="layout-column" id="app1">
            <?php
            include_once('../composants/header.php');
            ?>
            <div class="layout-column" style="gap: 5px;">
                <div class="layout-row" style="justify-content: space-between;">
                    <span id="numCode" style="color: #fff; font-weight: 600;">Code 1</span>
                    <div id="timer" style="color: #fff;">0s</div>
                    <span id="score" style="color: #fff; font-weight: 600;">0 Score</span>
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

        var leScore = 0;
        var score = document.getElementById('score');
        var leNumCode = 1;
        var numCode = document.getElementById('numCode');

        var tabResult = randomCombination();
        // tabResult = tabResult.split(",");
            
        console.log(tabResult);
        
        var tabColor = [[],[],[],[]];
        var rounds = 1;


        // Vérifier si le code est juste
        function checkColor() {
            // Vérifier que le code soit de longueur 4
            if (tabColor[rounds - 1].length === 4) {
                var verifyColor = [0,0,0,0];
                var verifyFalseColor = [0,0,0,0];
                
                // Souligné en VERT toutes les couleurs bien placées
                for (var i = 0; i < verifyColor.length; i++) {
                    if (tabColor[rounds - 1][i] === tabResult[i]) {
                        verifyColor[i] = 1;
                        var span = document.querySelectorAll("#round-" + rounds + " span")[i];
                        span.classList.add('green');
                    }
                }
                
                // Souligné en ORANGE toutes les bonnes couleurs malplacées
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

                // Désactiver les boutons si leur couleur n'est pas dans le code secret
                for (i=0; i<tabResult.length; i++) {
                    var isIn = false;
                    for (j=0; j<tabResult.length; j++) {
                        if (tabResult[j] === tabColor[rounds - 1][i]) {
                            isIn = true;
                        }
                    }
                    // if (!(isIn)) {
                    //     var btn = document.querySelectorAll("#" + tabColor[rounds - 1][i]);
                    //     btn[0].classList.add("disable");
                    // }
                }

                // Si le code et le code secret sont similaire alors
                if (JSON.stringify(tabResult) === JSON.stringify(tabColor[rounds - 1])) {
                    // Le joueur a gagné
                    // alert("Bravo, vous avez trouvé la combinaison secrète !");
                    // Le score augmente
                    leScore += (5 - rounds)*150;
                    score.innerHTML = leScore + " Score";
                    // Code suivant
                    leNumCode++;
                    numCode.innerHTML = "Code " + leNumCode;

                    restart();
                    
                } else {
                    if (rounds === 4) {
                        // Le joueur a épuisé ses tentatives, il a perdu
                        // alert("Vous avez épuisé vos tentatives. La combinaison secrète était : " + tabResult.join(' '));

                        clearInterval(timerInterval); // Arrêter le timer

                        document.getElementById("text").innerHTML = "Nombre de décodage : " + (leNumCode-1) + "<br/>Score : " + leScore + "<br/>Time : " + timerDisplay.textContent;

                        app1.style.display = "none";
                        app2.style.display = "flex";

                    } else {
                        // Passer à la prochaine manche
                        rounds++;
                    }
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