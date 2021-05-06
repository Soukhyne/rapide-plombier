    <!--MAIN CONTENT-->
    <!-- redirection if javascript is not running -->
    <noscript>
        <meta http-equiv="Refresh" content="0 index.php?page=commentairesNoJS" />
    </noscript>
    <main class="wraper">
        <h1>Commentaires</h1>
        <div >
            <div>
                <form class="commentaires" id="commentaires"  method="POST">
                    <fieldset>
                        <div class="col">
                            <label for="lastName">Veuillez entrer votre nom</label> 
                            <input type="text" name="lastName" id="lastName">
                            <span class ="hide" id="missingLastName">Format de nom incorrect ou incomplet</span>
                        </div>
                        <div class="col text">
                            <span class ="hide" id="missingComment">Veuillez saisir un commentaire inférieur à 500 charactères</span>
                            <textarea name="comment" id="comment" maxlength=500 placeholder="Votre commentaire..."></textarea>
                        </div>
                        <div class="submit">
                            <button class="button" id="commentButton" type="submit">Envoyer</button>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div>
                <h2 id="test">Avis des clients</h2>
                <div id="commentsList"></div>
                <!-- automatic display of comments extracted from the database -->
            </div>
        </div>
    </main>