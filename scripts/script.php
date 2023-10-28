<?php
include('../scripts/functions.php');

$random = randomCombination();
$randomJSON = json_encode($random);

// Requête SELECT avec préparation
// Préparez la requête avec un paramètre nommé :id
$requete = $conn->prepare("SELECT score_solo FROM users WHERE id = :id");
// Liez la valeur du paramètre :id
$requete->bindParam(':id', $_SESSION['ID'], PDO::PARAM_INT);

// Exécutez la requête
if ($requete->execute()) {
    // Récupérez les résultats
    $row = $requete->fetch();

    if (empty($row)) {
        $MAX_SCORE = 0;
    } else {
        $MAX_SCORE = $row['score_solo'];
    }
    
} else {
    echo "Erreur lors de l'exécution de la requête : " . implode(" - ", $requete->errorInfo());
    $MAX_SCORE = 0;
}
?>

<script>
    var leScore = 0;
    var score = document.getElementById('score');
    var leNumCode = 1;
    var numCode = document.getElementById('numCode');

    var tabResult = <?= $randomJSON ?>;
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
                if (!(isIn)) {
                    var btn = document.querySelectorAll("#" + tabColor[rounds - 1][i]);
                    btn[0].classList.add("disable");
                }
            }

            // Si le code et le code secret sont similaire alors
            if (JSON.stringify(tabResult) === JSON.stringify(tabColor[rounds - 1])) {
                // Le joueur a gagné
                alert("Bravo, vous avez trouvé la combinaison secrète !");
                // Le score augmente
                leScore += (5 - rounds)*150;
                score.innerHTML = leScore + " Score";
                // Code suivant
                leNumCode++;
                numCode.innerHTML = "Code " + leNumCode;

                if (leScore > <?= $MAX_SCORE ?>) {
                    // Créez un objet de données JSON contenant le score
                    var data = {
                        score: leScore
                    };
    
                    // Effectuez la requête AJAX
                    $.ajax({
                        type: "POST", // Utilisez la méthode POST pour envoyer les données
                        url: "../pages/solo.php", // Spécifiez l'URL du script PHP côté serveur
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
                }

                restart();
                
            } else {
                if (rounds === 4) {
                    // Le joueur a épuisé ses tentatives, il a perdu
                    alert("Vous avez épuisé vos tentatives. La combinaison secrète était : " + tabResult.join(' '));
                } else {
                    // Passer à la prochaine manche
                    rounds++;
                }
            }
        }
    }
</script>