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
        <meta name="description" content="Administrateur">
        <title>Rapide Plombier - Administrateur</title>
        <link rel="stylesheet" href="./../../css/normalize.css">
        <link rel="stylesheet" href="./../../css/style.css">
    </head>
    <body>
        <main>
            <div class="wraper">
                <div id="allActions" class="inputFlex">
                    <p class="noJS">Le site étant optimisé pour Javascript, votre navigation sera plus agréable si vous le réactivez.</p>
                    <h3>Toutes les interventions</h3>
                    <ul class="actions active">
                        <li>Date</li>
                        <li>Nom</li>
                        <li>Prénom</li>
                    </ul>
                    <!-- automatic display of latest interventions extracted from the database -->
                    <?php
                    require_once './../../services/functionsNoJS.php';
                    $lastActions = allActionsNoJS();
                    foreach($lastActions as $act) {
                    ?>
                    <div>
                        <ul class="actions">
                            <li><?=$act[date]?></li>
                            <li><?=$act[lastname]?></li>
                            <li><?=$act[firstname]?></li>
                        </ul>
                    </div> 
                    <?php
                    }
                    ?>
                </div>
            </div>
            <a class="index" href="./administrateurNoJS.php"> Retour</a>
        </main>
        <footer>
            <div id="footer" class="wraper">
                <div class="droits">
                    <p class="wraper">Madeline LAFONT © 2021</p>
                    <p class="wraper">Tous droits réservés </p>
                </div>
            </div>
        </footer>
        <script type="module" src="./../../js/app.js"></script>
    </body>
</html>