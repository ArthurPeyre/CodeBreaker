<?php
function randomCombination() {
    $colors = ["red", "green", "blue", "yellow", "white", "black"];
    $combinaison = [];

    for ($i = 0; $i < 4; $i++) {
        // Sélectionnez un élément aléatoire parmi les éléments disponibles
        $randomColor = $colors[array_rand($colors)];
        
        // Ajoutez l'élément à la combinaison
        $combinaison[] = $randomColor;
    }

    // Utilisez implode pour transformer le tableau en une chaîne de caractères
    $combinaisonString = implode(",", $combinaison);

    return $combinaisonString;
}
?>

<script>

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

</script>