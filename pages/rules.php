<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeBreaker - Rules</title>

    <link rel="stylesheet" href="../style.css">
</head>
<body class="layout-column" style="justify-content: space-between;">

<?php
include_once('../composants/header.php');
?>

    <div class="layout-column" style="flex-grow: 1;gap: min(2.5vh,10px);">
        <div class="container">
            <p>Vous avez 6 essais pour découvrir le code</p>
        </div>
        <div class="container">
            <p>Le code peut contenir plusieurs boules de même couleur</p>
        </div>
        <div class="container">
            <p>Une boule soulignée en VERT est bien placée</p>
            <div class="little-layout-row">
                <div class="little-layout-column balls">
                    <svg class="ball" width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#BE0F0F"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17.1071 37.1069C28.1528 37.1069 37.1071 28.1526 37.1071 17.1069C37.1071 12.3481 35.4451 7.97755 32.6698 4.54395C37.2062 8.21037 40.1072 13.8199 40.1072 20.1069C40.1072 31.1526 31.1529 40.1069 20.1072 40.1069C13.8202 40.1069 8.21086 37.2061 4.54443 32.6699C7.97799 35.445 12.3485 37.1069 17.1071 37.1069Z" fill="#8E0000"/></svg>
                    <span></span>
                </div>
                <div class="little-layout-column balls">
                    <svg class="ball" width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#1010EE"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17.1071 37.1069C28.1528 37.1069 37.1071 28.1526 37.1071 17.1069C37.1071 12.3481 35.4451 7.97755 32.6698 4.54395C37.2062 8.21037 40.1072 13.8199 40.1072 20.1069C40.1072 31.1526 31.1529 40.1069 20.1072 40.1069C13.8202 40.1069 8.21086 37.2061 4.54443 32.6699C7.97799 35.445 12.3485 37.1069 17.1071 37.1069Z" fill="#0909C0"/></svg>
                    <span class="green"></span>
                </div>
                <div class="little-layout-column balls">
                    <svg class="ball" width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#DDDDDD"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17.1071 37.1069C28.1528 37.1069 37.1071 28.1526 37.1071 17.1069C37.1071 12.3481 35.4451 7.97755 32.6698 4.54395C37.2062 8.21037 40.1072 13.8199 40.1072 20.1069C40.1072 31.1526 31.1529 40.1069 20.1072 40.1069C13.8202 40.1069 8.21086 37.2061 4.54443 32.6699C7.97799 35.445 12.3485 37.1069 17.1071 37.1069Z" fill="#B4B4B4"/></svg>
                    <span></span>
                </div>
                <div class="little-layout-column balls">
                    <svg class="ball" width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#E3E327"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17.1071 37.1069C28.1528 37.1069 37.1071 28.1526 37.1071 17.1069C37.1071 12.3481 35.4451 7.97755 32.6698 4.54395C37.2062 8.21037 40.1072 13.8199 40.1072 20.1069C40.1072 31.1526 31.1529 40.1069 20.1072 40.1069C13.8202 40.1069 8.21086 37.2061 4.54443 32.6699C7.97799 35.445 12.3485 37.1069 17.1071 37.1069Z" fill="#B6B600"/></svg>
                    <span class="green"></span>
                </div>
            </div>
        </div>
        <div class="container">
            <p>Une boule soulignée en ORANGE existe dans le code mais est mal placée</p>
            <div class="little-layout-row">
                <div class="little-layout-column balls">
                    <svg class="ball" width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#BE0F0F"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17.1071 37.1069C28.1528 37.1069 37.1071 28.1526 37.1071 17.1069C37.1071 12.3481 35.4451 7.97755 32.6698 4.54395C37.2062 8.21037 40.1072 13.8199 40.1072 20.1069C40.1072 31.1526 31.1529 40.1069 20.1072 40.1069C13.8202 40.1069 8.21086 37.2061 4.54443 32.6699C7.97799 35.445 12.3485 37.1069 17.1071 37.1069Z" fill="#8E0000"/></svg>
                    <span class="orange"></span>
                </div>
                <div class="little-layout-column balls">
                    <svg class="ball" width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#1010EE"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17.1071 37.1069C28.1528 37.1069 37.1071 28.1526 37.1071 17.1069C37.1071 12.3481 35.4451 7.97755 32.6698 4.54395C37.2062 8.21037 40.1072 13.8199 40.1072 20.1069C40.1072 31.1526 31.1529 40.1069 20.1072 40.1069C13.8202 40.1069 8.21086 37.2061 4.54443 32.6699C7.97799 35.445 12.3485 37.1069 17.1071 37.1069Z" fill="#0909C0"/></svg>
                    <span class="green"></span>
                </div>
                <div class="little-layout-column balls">
                    <svg class="ball" width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#DDDDDD"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17.1071 37.1069C28.1528 37.1069 37.1071 28.1526 37.1071 17.1069C37.1071 12.3481 35.4451 7.97755 32.6698 4.54395C37.2062 8.21037 40.1072 13.8199 40.1072 20.1069C40.1072 31.1526 31.1529 40.1069 20.1072 40.1069C13.8202 40.1069 8.21086 37.2061 4.54443 32.6699C7.97799 35.445 12.3485 37.1069 17.1071 37.1069Z" fill="#B4B4B4"/></svg>
                    <span></span>
                </div>
                <div class="little-layout-column balls">
                    <svg class="ball" width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#E3E327"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17.1071 37.1069C28.1528 37.1069 37.1071 28.1526 37.1071 17.1069C37.1071 12.3481 35.4451 7.97755 32.6698 4.54395C37.2062 8.21037 40.1072 13.8199 40.1072 20.1069C40.1072 31.1526 31.1529 40.1069 20.1072 40.1069C13.8202 40.1069 8.21086 37.2061 4.54443 32.6699C7.97799 35.445 12.3485 37.1069 17.1071 37.1069Z" fill="#B6B600"/></svg>
                    <span class="green"></span>
                </div>
            </div>
        </div>
        <div class="container">
            <p>Une boule non-soulignée n’existe pas dans le code</p>
            <div class="little-layout-row">
                <div class="little-layout-column balls">
                    <svg class="ball" width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#BE0F0F"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17.1071 37.1069C28.1528 37.1069 37.1071 28.1526 37.1071 17.1069C37.1071 12.3481 35.4451 7.97755 32.6698 4.54395C37.2062 8.21037 40.1072 13.8199 40.1072 20.1069C40.1072 31.1526 31.1529 40.1069 20.1072 40.1069C13.8202 40.1069 8.21086 37.2061 4.54443 32.6699C7.97799 35.445 12.3485 37.1069 17.1071 37.1069Z" fill="#8E0000"/></svg>
                    <span class="orange"></span>
                </div>
                <div class="little-layout-column balls">
                    <svg class="ball" width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#1010EE"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17.1071 37.1069C28.1528 37.1069 37.1071 28.1526 37.1071 17.1069C37.1071 12.3481 35.4451 7.97755 32.6698 4.54395C37.2062 8.21037 40.1072 13.8199 40.1072 20.1069C40.1072 31.1526 31.1529 40.1069 20.1072 40.1069C13.8202 40.1069 8.21086 37.2061 4.54443 32.6699C7.97799 35.445 12.3485 37.1069 17.1071 37.1069Z" fill="#0909C0"/></svg>
                    <span class="green"></span>
                </div>
                <div class="little-layout-column balls">
                    <svg class="ball" width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#DDDDDD"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17.1071 37.1069C28.1528 37.1069 37.1071 28.1526 37.1071 17.1069C37.1071 12.3481 35.4451 7.97755 32.6698 4.54395C37.2062 8.21037 40.1072 13.8199 40.1072 20.1069C40.1072 31.1526 31.1529 40.1069 20.1072 40.1069C13.8202 40.1069 8.21086 37.2061 4.54443 32.6699C7.97799 35.445 12.3485 37.1069 17.1071 37.1069Z" fill="#B4B4B4"/></svg>
                    <span></span>
                </div>
                <div class="little-layout-column balls">
                    <svg class="ball" width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#E3E327"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17.1071 37.1069C28.1528 37.1069 37.1071 28.1526 37.1071 17.1069C37.1071 12.3481 35.4451 7.97755 32.6698 4.54395C37.2062 8.21037 40.1072 13.8199 40.1072 20.1069C40.1072 31.1526 31.1529 40.1069 20.1072 40.1069C13.8202 40.1069 8.21086 37.2061 4.54443 32.6699C7.97799 35.445 12.3485 37.1069 17.1071 37.1069Z" fill="#B6B600"/></svg>
                    <span class="green"></span>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>