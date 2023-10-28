<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeBreaker - Code du jour</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="icon" type="image/x-icon" href="https://ayico.fr/images/logo/logo.ico">
</head>
<body>
    <div class="layout-column" id="app">
        <?php
include_once('../composants/header.php');
if (!isset($_SESSION['ACCOUNT'])) {
    header('location: ./login.php');
}

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
    exit;
}

include_once('../composants/tabBalls.php');
include_once('../composants/clavier.php');

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
            } else if (rounds === 4) {
                // Le joueur a épuisé ses tentatives, il a perdu
                alert("Vous avez épuisé vos tentatives. La combinaison secrète était : " + tabResult.join(' '));
            } else {
                // Passer à la prochaine manche
                rounds++;
            }
        }
    }
</script>

</body>
</html>