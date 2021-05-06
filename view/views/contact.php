    <!--MAIN CONTENT-->
    <!-- redirection if javascript is not running -->
    <noscript>
        <meta http-equiv="Refresh" content="0 index.php?page=contactNoJS" />
    </noscript>
    <main class="wraper">
        <article class="overflow">
            <h1>Contact</h1>
            <img class="img-left" src="img/image2.jpg" alt="plombier">
            <p>Vous avez une <span>urgence</span> ! Une fuite, un WC, une canalisation bouchée... ou tout autre problème qui nécessite l’intervention d’un plombier professionnel en urgence.</p>
            <p>Je suis à vos côtés pour vous fournir des services d’urgence et des solutions de remplacement.</p>
            <p>Disponible <span>7j/7 de 8h à 22h.</span></p>
            <p>Je mets tout en œuvre pour intervenir le plus rapidement possible.</p>
            <p>Profitez de services de dépannage en urgence et profitez de votre confort de vie.</p>
        </article>
        <article>
            <h2> Contactez-moi</h2>
            <form id="contact" class="contact"  method="POST">
                <fieldset>
                    <div class="flexform">
                        <div class="col">
                            
                            <div class="inputFlex">
                                <label for="name">Veuillez entrer votre nom</label>    
                                <input type="text" name="name" id="name" pattern="^[a-zA-ZÊÈÉÀéèêîïà][a-zéèêîïçà]+([-'\s][a-zA-ZÊÈÉÀéèêîïà][a-zéèêîïçà]+)?">
                                <span class ="hide" id="missingName">Format de nom incorrect</span>
                            </div>

                            <div class="inputFlex">
                                <label for="phone">Votre numéro de téléphone</label>
                                <input type="tel" name="phone" id="phone" placeholder="06..." pattern="[0-9]{10}"> 
                                <span class ="hide" id="missingPhone">Format de téléphone incorrect</span>
                            </div>

                            <div class="inputFlex">
                                <label for="email">Votre adresse mail</label>
                                <input type="email" name="email" id="email" placeholder="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$'>
                                <span class ="hide" id="missingEmail">Format d'adresse mail incorrect</span>
                            </div>

                            <div class="inputRow">
                                <input name="politique" id="politique" type="checkbox" required >
                                <label for="politique"> J'ai lu et accepte la <a href="./view/views/politique.php" target="_blank" title="Politique de confidentialité">Politique de confidentialité.</a> </label>
                            </div>
                        </div>
                        <div class="col text">
                            <select name="object" required>
                                <option value=""> choisir </option>
                                <option value="0">Signaler une urgence</option>
                                <option value="1">Demander de devis</option>
                                <option value="2">Autre</option>
                            </select>
                            <textarea name="query" id="querry" placeholder="Votre message..."></textarea>
                        </div>
                    </div>
                    
                    <div class="submit">
                        <button class="button" id="contactButton" type="submit">Envoyer</button>
                    </div>
                </fieldset>
            </form>
        </article>     
    </main>