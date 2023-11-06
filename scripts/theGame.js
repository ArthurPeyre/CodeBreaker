// <=== Fonctions COOKIES ===>

function setCookie(name, value, time) {
    let date = new Date(Date.now() + time); //86400000ms = 1 jour
    date = date.toUTCString();

    document.cookie = name + "=" + value + "; path=/; expires=" + date;
}

function setCookieExpiresAtMidnight(name, value) {
    // Obtenir la date actuelle
    let date = new Date();

    // Réinitialiser l'heure à minuit pour la date actuelle
    date.setHours(24, 0, 0, 0); // Définit l'heure à 24 (minuit), les minutes et secondes à 0

    // Convertir la date en format UTC pour la chaîne de cookie
    let expires = date.toUTCString();

    // Créer le cookie avec la date d'expiration à minuit
    document.cookie = name + "=" + value + "; path=/; expires=" + expires;
}


function getCookieValue(name) {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }
        if (cookie.indexOf(name + '=') === 0) {
            return cookie.substring(name.length + 1, cookie.length);
        }
    }

    return ""; // Renvoie une chaîne vide si le cookie n'est pas trouvé
}


function deleteCookie(name) {
    document.cookie = name + "=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC";
}

function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }
}



 
// <=== Fonctions JEU ===>

// Générer un code aléatoire
function randomCombination() {
    var colors = ["red", "green", "blue", "yellow", "white", "black"];
    var combinaison = [];

    for (let i = 0; i < 4; i++) {
        // Sélectionnez un élément aléatoire parmi les éléments disponibles
        var randomColor = colors[Math.floor(Math.random() * colors.length)];

        // Ajoutez l'élément à la combinaison
        combinaison.push(randomColor);
    }

    return combinaison;
}

// Recommencement du jeu
function restart() {
    var colors = ["red", "green", "blue", "yellow", "white", "black"];
    // Réinitialisation des variables
    tabResult = randomCombination();
    tabColor = [[],[],[],[]];
    rounds = 1;

    for (let i = 1; i<=4; i++) { // ROUNDS
        for (let j = 0; j<4; j++){ // BALL
            ball = document.querySelectorAll("#round-" + i + " .ball circle")[j].style.fill = "transparent";
            path = document.querySelectorAll("#round-" + i + " .ball path")[j].style.fill = "transparent";
            span = document.querySelectorAll("#round-" + i + " span")[j];
            span.classList.remove('green');
            span.classList.remove('orange');
        }
    }

    for (i=0;i<6;i++) {
        var btn = document.querySelectorAll("#" + colors[i]);
        if (btn[0].classList.contains('disable')) {
            btn[0].classList.remove("disable");
        }
    }


}

// ...
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

// ...
function delColor() {
    if (tabColor[rounds - 1].length > 0) {
        ball = document.querySelectorAll("#round-" + rounds + " .ball circle")[tabColor[rounds - 1].length - 1].style.fill = "transparent";
        path = document.querySelectorAll("#round-" + rounds + " .ball path")[tabColor[rounds - 1].length - 1].style.fill = "transparent";
        
        tabColor[rounds - 1].splice(tabColor[rounds - 1].length-1,1);
    }
}















// function checkColor() {
//     if (tabColor[rounds - 1].length === 4) {
//         var verifyColor = [0,0,0,0];
//         var verifyFalseColor = [0,0,0,0];
        
//         for (var i = 0; i < verifyColor.length; i++) {
//             if (tabColor[rounds - 1][i] === tabResult[i]) {
//                 verifyColor[i] = 1;
//                 var span = document.querySelectorAll("#round-" + rounds + " span")[i];
//                 span.classList.add('green');
//             }
//         }
        
//         if (verifyColor.includes(0)) {
//             for (i = 0; i<verifyColor.length; i++) {
//                 if (verifyColor[i] === 0) {
//                     for (j = 0; j<tabResult.length; j++) {
//                         if (i !== j && verifyColor[j] === 0 && verifyFalseColor[j] === 0 && tabResult[j] === tabColor[rounds - 1][i]) {
//                             var span = document.querySelectorAll("#round-" + rounds + " span")[i];
//                             span.classList.add('orange');
//                             verifyFalseColor[j] = 1;
//                         }
//                     }
//                 }
//             }
//         }

//         for (i=0; i<tabResult.length; i++) {
//             var isIn = false;
//             for (j=0; j<tabResult.length; j++) {
//                 if (tabResult[j] === tabColor[rounds - 1][i]) {
//                     isIn = true;
//                 }
//             }
//             if (!(isIn)) {
//                 var btn = document.querySelectorAll("#" + tabColor[rounds - 1][i]);
//                 btn[0].classList.add("disable");
//             }
//         }

//         if (JSON.stringify(tabResult) === JSON.stringify(tabColor[rounds - 1])) {
//             // Le joueur a gagné
//             // alert("Bravo, vous avez trouvé la combinaison secrète !");

//             // Enregistrer le Cookie CodeOfTheDay de valeur WIN
//             // deleteCookieAtMidnight("CodeOfTheDay", "true");
//             setCookie("CodeOfTheDay", "true", 1);

//             // Rafraîchir la page actuelle
//             window.location.reload();

//         } else if (rounds === 4) {
//             // Le joueur a épuisé ses tentatives, il a perdu
//             // alert("Vous avez épuisé vos tentatives. La combinaison secrète était : " + tabResult.join(' '));

//             // Enregistrer le Cookie CodeOfTheDay de valeur LOOSE
//             deleteCookieAtMidnight("CodeOfTheDay", "false");

//             // Rafraîchir la page actuelle
//             window.location.reload();
            
//         } else {
//             // Passer à la prochaine manche
//             rounds++;
//         }
//     }
// }




/* <div class="layout-column" id="app1">
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

    include_once('../composants/tabBalls.php');
    include_once('../composants/clavier.php');
    ?>

</div> */