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
<!--Admin page without Javascript-->
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
        <p class="noJS">Le site étant optimisé pour Javascript, votre navigation sera plus agréable si vous le réactivez.</p>
        <article>
            <h2 class="admin">Modifier le compte</h2>
            <div class="wraper adminflex">
                <form id="adminFormNoJS" action="./../../services/loginNoJS.php" method="POST">
                    <div class="accountFlex">
                        <div>
                            <input type="hidden" name="action" value="changeUser">
                            <input type="hidden" name="idSession" value="<?= $id ?>">
                            <h3>Modification de mot de passe</h3>
                            <div class="col inputFlex">
                                <label for="newPwdNoJS">Veuillez entrer votre nouveau mot de passe</label>
                                <input type="password" name="newPwdNoJS" id="newPwdNoJS">
                            </div>
                            <div class="col inputFlex">
                                <label for="pwd_confirmNoJS">Veuillez confirmer votre mot de passe</label>
                                <input type="password" name="pwd_confirmNoJS" id="pwd_confirmNoJS">
                            </div>
                        </div>
                        <div>
                            <div class="col inputFlex">
                            <h3>Modification de l'adresse mail</h3>
                                <label for="newEmailNoJS">Veuillez entrer votre nouvelle adresse mail</label>
                                <input type="email" name="newEmailNoJS" id="newEmailNoJS">
                            </div>
                            <div class="col inputFlex">
                                <label for="email_confirmNoJS">Veuillez confirmer votre adresse</label>
                                <input type="email" name="email_confirmNoJS" id="email_confirmNoJS">
                            </div>
                        </div>
                    </div>
                    <div class="submit inputFlex">
                        <button class="button" type="submit">Modifier</button>
                    </div>
                </form>
                <?php
                    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    if (strpos($fullUrl, "inputs=empty") == true) {
                        echo "Veuillez remplir les champs";
                    } elseif (strpos($fullUrl, "pwd=notok") == true) {
                        echo "Les mots de passe ne sont pas identiques";
                    } elseif (strpos($fullUrl, "pwd=regex") == true) {
                        echo "Le mot de passe ne correspond pas à la syntaxe demandé : caractères ( 8à 15), et au moins une lettre minuscule, majuscule, un chiffre, un caractère spécial";
                    } elseif (strpos($fullUrl, "pwd=ok") == true) {
                        echo "Le mot de passe a bien été modifié";
                    } elseif (strpos($fullUrl, "email=notok") == true) {
                        echo "Les deux adresses ne sont pas identiques";
                    } elseif (strpos($fullUrl, "email=regex") == true) {
                        echo "Veuillez saisir un adresse email correcte";
                    } elseif (strpos($fullUrl, "email=ok") == true) {
                        echo "L'adresse email a bien été modifiée";
                    } elseif (strpos($fullUrl, "input=notok") == true) {
                        echo "Les champs ne sont pas identiques";
                    } elseif (strpos($fullUrl, "all=ok") == true) {
                        echo "Email et mot de passe ont bien été changés";
                    } elseif (strpos($fullUrl, "erreur=ok") == true) {
                        echo "Une erreur est survenue";
                    } 
                ?>
            </div>
        </article>
        <article>
            <h2 class="admin">Modérer les commentaires</h2>
            <div class="wraper">
                <form id="deleteFormNoJS" class="deleteForm submit" action="./../../services/CommentFormNoJS.php" method="POST" >
                    <input type="hidden" name="action" value="delete">
                    <!-- automatic display of comments extracted from the database -->
                    <?php
                        require_once './../../services/functionsNoJS.php';
                        $allComments = refreshNoJS();
                        foreach($allComments as $comm) {
                    ?>
                    <div>
                        <input type="checkbox" name="comm[]" value="<?=$comm[id]?>">
                        <label for="comm<?=$comm[id]?>"><?=$comm[name]." : ".$comm[comment]?></label>
                    </div> 
                    <?php
                        }
                    ?>
                    <button class="button centerButton" type="submit">Supprimer les commentaires</button>
                </form>
                <?php
                    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    if (strpos($fullUrl, "input=empty") == true) {
                        echo "Vous devez sélectionner au moins un commentaire";
                    } elseif (strpos($fullUrl, "delete=ok") == true) {
                        echo "Commentaire supprimé";
                    } elseif (strpos($fullUrl, "delete=notok") == true) {
                        echo "Une erreur est survenue";
                    }
                ?>
            </div>
        </article>
        <article>
            <h2 class="admin">Clients</h2>
            <div class="wraper adminflex">
                <div>
                    <form id="newCustomerNoJS" action="./../../services/CustomerNoJS.php" method="POST">
                        <input type="hidden" name="action" value="newCustomer">
                        <h3>Nouveau client</h3>
                        <div class="col inputFlex">
                            <label for="nameCustomerNoJS">Nom de famille</label>
                            <input type="text" name="nameCustomerNoJS" id="nameCustomerNoJS">
                        </div>
                        <div class="col inputFlex">
                            <label for="firstnameCustomerNoJS">Prénom</label>
                            <input type="text" name="firstnameCustomerNoJS" id="firstnameCustomerNoJS">
                        </div>
                        <div class="col inputFlex">
                            <label for="emailCustomerNoJS">Email</label>
                            <input type="email" name="emailCustomerNoJS" id="emailCustomerNoJS">
                        </div>
                        <div class="col inputFlex">
                            <label for="phoneCustomerNoJS">Telephone</label>
                            <input type="tel" name="phoneCustomerNoJS" id="phoneCustomerNoJS">
                        </div>
                        <div class="submit">
                            <button class="button" type="submit">Enregistrer</button>
                        </div>
                    </form>
                    <?php
                    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    if (strpos($fullUrl, "namecust=empty") == true) {
                        echo "Merci de compléter tous les champs";
                    } elseif (strpos($fullUrl, "customer=already") == true) {
                        echo "Le client existe déjà";
                    } elseif (strpos($fullUrl, "newcustomer=error") == true) {
                        echo "Une erreur est survenue";
                    } elseif(strpos($fullUrl, "newcustomer=OK") == true) {
                        echo "Le client a été enregistré";
                    }
                    ?>
                </div>
                <div>
                    <form id="searchCustomerNoJS" action="./../../services/CustomerNoJS.php" method="POST">
                        <input type="hidden" name="action" value="changeCustomer">
                        <div class="col inputFlex">
                        <h3>Modification d'un client</h3>
                            <label for="nameSearchNoJS">Veuillez entrer le nom du client</label>
                            <input type="text" name="nameSearchNoJS" id="nameSearchNoJS">
                        </div>
                        <div class="col inputFlex">
                            <label for="newCustomerEmailNoJS">Modifier l'adresse mail :</label>
                            <input type="email" name="newCustomerEmailNoJS" id="newCustomerEmailNoJS">
                        </div>
                        <div class="col inputFlex">
                            <label for="newCustomerPhoneNoJS">Modifier le numéro de téléphone :</label>
                            <input type="tel" name="newCustomerPhoneNoJS" id="newCustomerPhoneNoJS">
                        </div>
                        <div class="submit">
                            <button class="button" type="submit">Modifier</button>
                        </div>
                    </form>
                    <?php
                    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    if (strpos($fullUrl, "namecustomer=notfill") == true) {
                        echo "Merci de compléter le nom";
                    } elseif (strpos($fullUrl, "customer=notknow") == true) {
                        echo "le client n'existe pas";
                    } elseif (strpos($fullUrl, "allinput=empty") == true) {
                        echo "Vous devez remplir un nouveau mail ou téléphone";
                    } elseif (strpos($fullUrl, "email=changed") == true) {
                        echo "L'adresse email a bien été changée";
                    } elseif (strpos($fullUrl, "phone=changed") == true) {
                        echo "Le numéro de téléphone a bien été changée";
                    }elseif (strpos($fullUrl, "all=changed") == true) {
                        echo "Téléphone et email ont bien été changés";
                    }
                    ?>
                </div>
            </div>
        </article>
        <article>
            <h2 class="admin">Facturation</h2>
            <div class="wraper">
                <div class="col inputFlex">

                    <h3>Dernières interventions</h3>
                    <ul class="actions active">
                        <li>Date</li>
                        <li>Nom</li>
                        <li>Prénom</li>
                    </ul>
                    <!-- automatic display of latest interventions extracted from the database --> 
                    <?php
                    require_once './../../services/functionsNoJS.php';
                    $lastActions = lastActionsNoJS();
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
                
                    <form class="lastActions" action="./../../services/InvoiceNoJS.php" method="POST">
                    <input type="hidden" name="action" value="allActions">
                        <div class="submit">
                            <button class="button centerButton" type="submit">Voir tout</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="wraper">
                <form id="searchInvoicesNoJS" action="./../../services/InvoiceNoJS.php" method="POST">
                    <input type="hidden" name="action" value="searchInvoice">
                    <div class="col inputFlex">
                        <h3>Afficher une facture</h3>
                        <label for="nameCustomerInvNoJS">Nom du client :</label>
                        <input type="text" name="nameCustomerInvNoJS" id="nameCustomerInvNoJS">
                    </div>
                    <div class="submit">
                        <button class="button" type="submit">Afficher</button>
                    </div>
                </form>
                <?php
                    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    if (strpos($fullUrl, "namecustomer=empty") == true) {
                        echo "Merci de compléter le nom";
                    } elseif (strpos($fullUrl, "customer=unknow") == true) {
                        echo "le client n'existe pas";
                    }
                    ?>
                <div class="resultInvoices">
                    <ul  class="hide invoice active">
                        <li>Détail</li>
                        <li>Montant unitaire</li>
                        <li>Quantité</li>
                        <li>Total</li>
                    </ul>
                </div>
            </div>
        </article>
        <form class="logoutNoJS" action="./../../services/loginNoJS.php" method="POST">
        <input type="hidden" name="action" value="logout">
        <button class="index" type="submit"> Se déconnecter</a>
        </form>
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