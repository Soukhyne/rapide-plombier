    <!--MAIN CONTENT-->
    <!--Contact page without Javascript-->
    <main class="wraper">
        <h1>Commentaires</h1>
        <p class="noJS">Le site étant optimisé pour Javascript, votre navigation sera plus agréable si vous le réactivez.</p>
        <div>
            <div>
                <form class="commentaires" id="commentairesNoJS" action="./services/CommentFormNoJS.php" method="POST">
                    <fieldset>
                        <div class="col">
                            <label for="lastNameNoJS">Veuillez entrer votre nom</label> 
                            <input type="text" name="lastNameNoJS" id="lastNameNoJS">
                        </div>
                        <div class="col text">
                            <textarea name="commentNoJS" id="commentNoJS"  placeholder="Votre commentaire..."></textarea>
                        </div>
                        <div class="submit">
                            <button class="button" type="submit">Envoyer</button>
                        </div>
                        <?php
                        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        if (strpos($fullUrl, "signup=empty") == true) {
                            echo "Merci de compléter tous les champs";
                        } elseif (strpos($fullUrl, "comment=long") == true) {
                            echo "Merci de noter un commentaire inférieur à 500 caractères";
                        } elseif (strpos($fullUrl, "comment=ok") == true) {
                            echo "Votre commentaire est bien posté";
                        }elseif (strpos($fullUrl, "comment=error") == true) {
                            echo "Une erreur est survenue";
                        }
                        ?>
                    </fieldset>
                </form>
            </div>
            <div>
                <h2>Avis des clients</h2>
                <div>
                <!-- automatic display of comments extracted from the database -->
                    <?php
                    require_once './services/functionsNoJS.php';
                    $allComments = refreshNoJS();
                    foreach($allComments as $comm) {
                    ?>
                    <div class="com-client">
                        <p class="client"><?=$comm[name]?></p>
                        <p class="date"><?=$comm[date]?></p>
                        <p><?=$comm[comment]?></p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>