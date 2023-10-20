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