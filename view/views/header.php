<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="plombier, intervention rapide, fuite, cuisine, salle de bain, sanitaire" />
        <meta name="description" content="Rapide Plombier">
        <meta name="robots" content="index"/>
        <!--automatic display title page-->
        <title>
            <?php if(isset($title)): ?>
                <?= $title ?>
            <?php else : ?>
                Rapide Plombier
            <?php endif ?>
        </title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header class="header" id="head">
            <nav class="wraper">
                <a href="index.php"><img src="img/logo.jpg" alt="logo"></a>
                <!--automatic highlight current page in nav-->
                <?php
                require 'tools/titleController.php';
                interactiveNav();
                ?>
            </nav>
            <div class="bg-img"></div>
        </header>