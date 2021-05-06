    <!--MAIN CONTENT-->
    <!--Contact page without Javascript-->
    <main class="wraper">
        <article class="overflow">
            <h1>Contact</h1>
            <p class="noJS">Le site étant optimisé pour Javascript, votre navigation sera plus agréable si vous le réactivez.</p>
            <img class="img-left" src="img/image2.jpg" alt="plombier">
            <p>Vous avez une <span>urgence</span> ! Une fuite, un WC, une canalisation bouchée... ou tout autre problème qui nécessite l’intervention d’un plombier professionnel en urgence.</p>
            <p>Je suis à vos côtés pour vous fournir des services d’urgence et des solutions de remplacement.</p>
            <p>Disponible <span>7j/7 de 8h à 22h.</span></p>
            <p>Je mets tout en œuvre pour intervenir le plus rapidement possible.</p>
            <p>Profitez de services de dépannage en urgence et profitez de votre confort de vie.</p>
        </article>
        <article>
            <h2> Contactez-moi</h2>
            <form class="contact" action="./services/ContactFormNoJS.php" method="POST">
                <fieldset>
                    <div class="flexform">
                        <div class="col">
                            
                            <div class="inputFlex">
                                <label for="nameNoJS">Veuillez entrer votre nom</label>    
                                <input type="text" name="nameNoJS" id="nameNoJS" pattern="^[a-zA-ZÊÈÉÀéèêîïà][a-zéèêîïçà]+([-'\s][a-zA-ZÊÈÉÀéèêîïà][a-zéèêîïçà]+)?">
                            </div>

                            <div class="inputFlex">
                                <label for="phoneNoJS">Votre numéro de téléphone</label>
                                <input type="tel" name="phoneNoJS" id="phoneNoJS" placeholder="06..." pattern="[0-9]{10}"> 
                            </div>

                            <div class="inputFlex">
                                <label for="emailNoJS">Votre adresse mail</label>
                                <input type="email" name="emailNoJS" id="emailNoJS" placeholder="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$'>
                            </div>

                            <div class="inputRow">
                                <input name="politiqueNoJS" id="politiqueNoJS" type="checkbox" required >
                                <label for="politiqueNoJS"> J'ai lu et accepte la <a href="./view/views/politique.php" target="_blank" title="Politique de confidentialité">Politique de confidentialité.</a> </label>
                            </div>
                        </div>
                        <div class="col text">
                            <select name="object" required>
                                <option value=""> choisir </option>
                                <option value="0">Signaler une urgence</option>
                                <option value="1">Demander de devis</option>
                                <option value="2">Autre</option>
                            </select>
                            <textarea name="queryNoJS" id="querryNoJS" placeholder="Votre message..."></textarea>
                        </div>
                    </div>
                    
                    <div class="submit">
                        <button class="button" type="submit">Envoyer</button>
                        
                    </div>
                    <div>
                        <?php
                        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        if (strpos($fullUrl, "signup=empty") == true) {
                            echo "Merci de compléter tous les champs";
                        } elseif (strpos($fullUrl, "name=notok") == true) {
                            echo "Merci de remplir un nom correct";
                        } elseif (strpos($fullUrl, "phone=notok") == true) {
                            echo "Merci de remplir un numéro de téléphone correct";
                        } elseif (strpos($fullUrl, "email=notok") == true) {
                            echo "Merci de remplir un email correct";
                        } elseif (strpos($fullUrl, "email=ok") == true) {
                            echo "Votre message a bien été envoyé";
                        }
                        ?>
                    </div>
                </fieldset>
            </form>
        </article>     
    </main>