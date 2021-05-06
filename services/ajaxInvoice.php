<?php
require_once './../models/Invoice.php';
$invoice = new Invoice;

//if GET exist and not empty
if (isset($_GET) && !empty($_GET)) {
    extract($_GET);
    //if input $nameCustomerInv exist and not empty, extract invoices for this customer
    if (isset($nameCustomerInv) && !empty($nameCustomerInv)) {
        $invoices = $invoice->findInvoices($nameCustomerInv);
        echo json_encode($invoices);
    //if input find exist and equal to latest, extract the 5 last interventions
    } elseif (isset($find) && $find === 'latest') {
        echo json_encode($invoice->findLatest());
    //if input find exist and equal to all, extract alls interventions
    } elseif (isset($find) && $find === 'all') {
        echo json_encode($invoice->findAll());
    }
//if POST exist and not empty
} elseif (isset($_POST) && !empty($_POST)) { 
    extract($_POST);
        try {
            //if one invoice is checked
            if (count($invoices) > 0) {
                //if input action = client info
                if ($action ==='clientinfo') {
                    //get in the database customers informations
                    foreach ($invoices as $invoiceNumber) {
                        echo json_encode($invoice->customerInformations(intval($invoiceNumber)));
                    }
                //if input action = invoice info
                } elseif ($action === 'invoiceinfo') {
                    //get in the database invoices informations
                    foreach ($invoices as $invoiceNumber) {
                        echo json_encode($invoice->invoiceInformations(intval($invoiceNumber)));
                    }
                //then
                } else {
                    //get in the database the total amount
                    foreach ($invoices as $invoiceNumber) {
                        echo json_encode($invoice->total(intval($invoiceNumber)));
                    }
                }
            }
        } catch (DomainException $e) {
            echo $e->getMessage();
        }
}