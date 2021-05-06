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
        <meta name="description" content="Connexion">
        <title>Rapide Plombier - Connexion</title>
        <link rel="stylesheet" href="./../../css/normalize.css">
        <link rel="stylesheet" href="./../../css/style.css">
    </head>
<body>
    <!-- redirection if javascript is not running -->
    <noscript>
        <meta http-equiv="Refresh" content="0 ./authNoJS.php" />
    </noscript>
    <main class="wraper">
        <div>
            <h1>Connexion</h1>
            <div>
                <form id="login" class="login" method="POST"  >
                    <input type="hidden" name="action" value="login">
                    <fieldset>
                        <div class="col">
                            <div class="inputFlex">
                                <label for="userName" >Identifiant:</label>
                                <input type="text" name="userName" id="userName">
                            </div>
                            <div class="inputFlex">
                                <label for="password" >Mot de passe:</label>
                                <input type="password" name="password" id="password">
                                <span class ="hide" id="missingInput">Merci de compléter tous les champs</span>
                            </div>
                            <div class="submit">
                                <button class="button" id="loginButton" type="submit">Se connecter</button>
                            </div>
                        </div>
                    </fieldset>
                </form>  
            </div>
        </div>
        <a class="index" href="./../../index.php"> Retourner à l'accueil</a>
    </main>
    <footer class="fixed">
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