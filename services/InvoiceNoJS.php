<?php
require_once './../models/Invoice.php';
$invoice = new Invoice;

//if POST exist and not empty
if (isset($_POST) && !empty($_POST)) { 
    extract($_POST);
    if ($action ==='searchInvoice') {
        //if input $nameCustomerInv exist and not empty, extract invoices for this customer
        if (isset($nameCustomerInvNoJS) && !empty($nameCustomerInvNoJS)) {
            require_once './../models/Customer.php';
            $customer = new Customer;
            if ($newCustomer = $customer->findByName($_POST['nameCustomerInvNoJS'])) {
                //echo ($newCustomer);
                //$invoice->customerInformations(intval($invoiceNumber))
                header('Location: ./../view/views/invoicesCustomer.php?customer='.$nameCustomerInvNoJS);
                exit();
            } else {
                header('Location: ./../view/views/administrateurNoJS.php?customer=unknow');
                exit();
            }
        } elseif (isset($nameCustomerInvNoJS) && empty($nameCustomerInvNoJS)) {
            header('Location: ./../view/views/administrateurNoJS.php?namecustomer=empty');
            exit();
        }
    //if input action = allActions
    } elseif ($action ==='allActions') {
        header('Location: ./../view/views/invoicesNoJS.php');
        exit();
    }
}