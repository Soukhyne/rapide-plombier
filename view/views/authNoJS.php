<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<!--Auth page without Javascript-->
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
    <main class="wraper">
        <div>
            <h1>Connexion</h1>
            <p class="noJS">Le site étant optimisé pour Javascript, votre navigation sera plus agréable si vous le réactivez.</p>
            <div>
                <form id="loginNoJS" action=" ./../../services/loginNoJS.php" class="login" method="POST"  >
                    <input type="hidden" name="action" value="login">
                    <fieldset>
                        <div class="col">
                            <div class="inputFlex">
                                <label for="userNameNoJS" >Identifiant:</label>
                                <input type="text" name="userNameNoJS" id="userNameNoJS">
                            </div>
                            <div class="inputFlex">
                                <label for="passwordNoJS" >Mot de passe:</label>
                                <input type="password" name="passwordNoJS" id="passwordNoJS">
                            </div>
                            <div class="submit">
                                <button class="button" type="submit">Se connecter</button>
                            </div>
                        </div>
                    </fieldset>
                </form>  
            </div>
        </div>
        <?php
            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if (strpos($fullUrl, "signup=empty") == true) {
                echo "Merci de compléter tous les champs";
            } elseif (strpos($fullUrl, "signup=fail") == true) {
                echo "Echec lors de l'authentification";
            } elseif (strpos($fullUrl, "signup=name") == true) {
                echo "L'utilisateur est inconnu";
            }elseif (strpos($fullUrl, "comment=error") == true) {
                            echo "Une erreur est survenue";
                        }
                        ?>
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