<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
extract($_GET); 
require_once './../../services/functionsNoJS.php';
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
        <?php
            $newCust = customerInfo($customer);
            foreach($newCust as $cust) {
        ?>
            <div class="wraper">
                <div id="allActions" class="inputFlex">
                    <h3>Facture</h3>
                    <!-- automatic display of customer extracted from the database -->
                    <p><?=$cust[lastname]." ".$cust[firstname]?> </p>
                    <p><?=$cust[email]?></p>
                    <p><?=$cust[phone]?></p>
                    <?php
                    }
                    ?>
                    <?php 
                    $newInv = invoiceInfo($customer);
                    foreach($newInv as $inv) {
                        ?> 
                        <!-- automatic display of invoices details extracted from the database -->
                        <p class="active">Facture n° <?=$inv[idInvoice]?></p>
                        <ul class="invoice active">
                            <li>Détail</li>
                            <li>Montant unitaire</li>
                            <li>Quantité</li>
                        </ul>
                        <?php
                        $detail = invoicesInfos($inv[idInvoice]);
                        foreach($detail as $det) {
                        ?>
                        <ul class="invoice">
                            <li><?=$det[product]?> </li>
                            <li><?=$det[unitprice]?></li>
                            <li><?=$det[quantity]?></li>
                        </ul>
                        <?php    
                        }
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