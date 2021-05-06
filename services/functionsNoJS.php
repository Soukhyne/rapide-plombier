<?php

function refreshNoJS() {
    require_once './models/Comment.php';
    $newComment = new Comment;
    $allComm = $newComment->findAllDesc();
   return($allComm);
}

function lastActionsNoJS() {
    require_once './../../models/Invoice.php';
    $invoice = new Invoice;
    $lastInv = $invoice->findLatest();
   return($lastInv);
}

function allActionsNoJS() {
    require_once './../../models/Invoice.php';
    $invoice = new Invoice;
    $lastInv = $invoice->findAll();
   return($lastInv);
}

function customerInfo($name) {
    require_once './../../models/Customer.php';
    $customer = new Customer;
    $newCustomer = $customer->findByName($name);
    return($newCustomer);
}

function invoiceInfo($name) {
    require_once './../../models/Invoice.php';
    $invoice = new Invoice;
    $newInv = $invoice->findInvoices($name);
    return($newInv);
}

function invoicesInfos($id) {
    require_once './../../models/Invoice.php';
    $invoice = new Invoice;
    $newInv = $invoice->invoiceInformations($id);
    return($newInv);
}



