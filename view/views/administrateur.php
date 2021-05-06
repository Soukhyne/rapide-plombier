<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

//if user is inactive avec 15 minutes, session is destroyed
if(isset($_SESSION['name'])) {
        if((time() - $_SESSION['last_time']) >= 1*60*15) {
            unset($_SESSION);
            session_destroy();
            header('Location:auth.php');
        } else {
            $_SESSION['last_time'] = time();
        }
    } else {
        header('Location:auth.php');
    }

    $id = $_SESSION["id"];
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
        <h1 class="wraper">Administrateur</h1>
        <article>
            <h2 class="admin">Modifier le compte</h2>
            <div class="wraper adminflex">
                <form id="adminForm" method="POST">
                    <div class="accountFlex">
                        <div>
                            <input type="hidden" name="action" value="changeUser">
                            <input type="hidden" name="idSession" value="<?= $id ?>">
                            <h3>Modification de mot de passe</h3>
                            <div class="col inputFlex">
                                <label for="newPwd">Veuillez entrer votre nouveau mot de passe</label>
                                <input type="password" name="newPwd" id="newPwd">
                            </div>
                            <div class="col inputFlex">
                                <label for="pwd_confirm">Veuillez confirmer votre mot de passe</label>
                                <input type="password" name="pwd_confirm" id="pwd_confirm">
                                <span class ="hide" id="missingPwd">Merci de compléter tous les champs</span>
                            </div>
                        </div>
                        <div>
                            <div class="col inputFlex">
                            <h3>Modification de l'adresse mail</h3>
                                <label for="newEmail">Veuillez entrer votre nouvelle adresse mail</label>
                                <input type="email" name="newEmail" id="newEmail">
                            </div>
                            <div class="col inputFlex">
                                <label for="email_confirm">Veuillez confirmer votre adresse</label>
                                <input type="email" name="email_confirm" id="email_confirm">
                                <span class ="hide" id="missingMail">Merci de compléter tous les champs</span>
                            </div>
                        </div>
                    </div>
                    <div class="submit inputFlex">
                        <button class="button" id="adminButton" type="submit">Modifier</button>
                        <span class ="hide" id="errorForm">Erreur</span>
                    </div>
                </form>
            </div>
        </article>
        <article>
            <h2 class="admin">Modérer les commentaires</h2>
            <div class="wraper">
                <form id="deleteForm" class="deleteForm submit">
                    <input type="hidden" name="action" value="delete">
                    <div id="adminCommentsList"></div>
                    <!-- automatic display of comments extracted from the database -->
                    <span class ="hide" id="deleteComment">Commentaire supprimé</span>
                    <button class="button centerButton" id="deleteButton" type="submit">Supprimer les commentaires</button>
                </form>
            </div>
        </article>
        <article>
            <h2 class="admin">Clients</h2>
            <div class="wraper adminflex">
                <div>
                    <form id="newCustomer" method="POST">
                        <input type="hidden" name="action" value="newCustomer">
                        <h3>Nouveau client</h3>
                        <div class="col inputFlex">
                            <label for="nameCustomer">Nom de famille</label>
                            <input type="text" name="nameCustomer" id="nameCustomer">
                        </div>
                        <div class="col inputFlex">
                            <label for="firstnameCustomer">Prénom</label>
                            <input type="text" name="firstnameCustomer" id="firstnameCustomer">
                        </div>
                        <div class="col inputFlex">
                            <label for="emailCustomer">Email</label>
                            <input type="email" name="emailCustomer" id="emailCustomer">
                        </div>
                        <div class="col inputFlex">
                            <label for="phoneCustomer">Telephone</label>
                            <input type="tel" name="phoneCustomer" id="phoneCustomer">
                            <span class ="hide" id="missingCustomer">Merci de compléter tous les champs</span>
                        </div>
                        <div class="submit">
                            <button class="button" id="customerButton" type="submit">Enregistrer</button>
                        </div>
                    </form>
                </div>
                <div>
                    <form id="searchCustomer" method="POST">
                        <input type="hidden" name="action" value="searchCustomer">
                        <div class="col inputFlex">
                        <h3>Modification d'un client</h3>
                            <label for="nameSearch">Veuillez entrer le nom du client</label>
                            <input type="text" name="nameSearch" id="nameSearch">
                        </div>
                    </form>
                    <form id="changeCustomer" method="POST">
                        <input type="hidden" name="action" value="changeCustomer">
                        <!-- automatic display of customers extracted from the database -->
                        <div class="result" id="result"></div>
                        <div class="col inputFlex">
                            <label for="newCustomerEmail">Modifier l'adresse mail :</label>
                            <input type="email" name="newCustomerEmail" id="newCustomerEmail">
                        </div>
                        <div class="col inputFlex">
                            <label for="newCustomerPhone">Modifier le numéro de téléphone :</label>
                            <input type="tel" name="newCustomerPhone" id="newCustomerPhone">
                            <span class ="hide" id="missingCustomerChange">Merci de compléter l'un des champs</span>
                        </div>
                        <div class="submit">
                            <button class="button" id="changeCustomerButton" type="submit">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
        <article>
            <h2 class="admin">Facturation</h2>
            <div class="wraper">
                <form id="lastActions" class="lastActions">
                    <div id="actions" class="col inputFlex">
                        <h3>Dernières interventions</h3>
                        <ul class="actions active">
                            <li>Date</li>
                            <li>Nom</li>
                            <li>Prénom</li>
                        </ul>
                        <!-- automatic display of latest interventions extracted from the database --> 
                    </div>
                    <div class="submit">
                        <button class="button centerButton" id="nextButton" type="submit">Voir tout</button>
                    </div>
                </form>
            </div>
            <div class="wraper">
                <form id="searchInvoices" method="POST">
                    <input type="hidden" name="action" value="searchInvoice">
                    <div class="col inputFlex">
                        <h3>Afficher une facture</h3>
                        <label for="nameCustomerInv">Nom du client :</label>
                        <input type="text" name="nameCustomerInv" id="nameCustomerInv">
                    </div>
                </form>
                <form id="editInvoice" class="editInvoice" method="POST">
                    <input type="hidden" name="action" value="editInvoice">
                    <div class="inputFlex">
                        <!-- automatic display of invoices extracted from the database -->
                        <div class="resultCustInvoices" id="resultInvoices"></div>
                    </div>
                    <div class="submit">
                        <button class="button" id="editInvoiceButton" type="submit">Afficher</button>
                    </div>
                </form>
                <div id ="invoicePrint">
                    <div class="resultInvoices" id="chosenInvoice"></div>
                        <div class="resultInvoices" id="chosenInvoiceTwo">
                            <ul id="invoiceDetails" class="hide invoice active">
                                <li>Détail</li>
                                <li>Montant unitaire</li>
                                <li>Quantité</li>
                                <li>Total</li>
                            </ul>
                        </div>
                    <div class="resultInvoices" id="chosenInvoiceThree">
                </div>
            </div>
        </article>
        <a class="index" id="logout" href="./../../index.php"> Se déconnecter</a>
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
    <script type="module" src="./../../js/reload.js"></script>
</body>
</html>