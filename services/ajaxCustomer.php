<?php
require_once './../models/Customer.php';
$customer = new Customer;

//if GET exist an not empty
if (isset($_GET) && !empty($_GET)) {
    extract($_GET);
    //if lastname input exist and exist in database
    if (isset($lastname) && !empty($customer->findByName($lastname))) {
        echo json_encode($customer->findByName($lastname));
    }
// if POST exist and not empty
} elseif (isset($_POST) && !empty($_POST)) {
    extract($_POST);
    //if input action = newCustomer, add a new one
    if ($action === "newCustomer") {
        try {
            if (!empty($nameCustomer) && !empty($firstnameCustomer) && !empty($emailCustomer) && !empty($phoneCustomer)) {
                //check if customer already exist in Database.
                if ($newCustomer = $customer->findByEmail($_POST['emailCustomer'])) {
                    throw new DomainException("Le client existe déjà");
                } else {
                    //call insert method
                    $customer->insertCustomer($nameCustomer, $firstnameCustomer, $emailCustomer, $phoneCustomer);
                }
            } else echo ('Veuillez remplir tous les champs');
        } catch (DomainException $e) {
            echo $e->getMessage();
        }
    //if input action = changeCustomer
    } else if ($action === 'changeCustomer') {
        //update a customer
        try {
            //if one customer is checked
            if(count($customers) > 0) {
                //if email is not empty AND phone is empty
                if (!empty($newCustomerEmail) && empty($newCustomerPhone)) {
                    foreach ($customers as $id) {
                        $customer->updateEmail(intval($id), $newCustomerEmail);
                        echo('Adresse email mise à jour');
                    }
                //if email is empty AND phone is not empty
                } elseif (empty($newCustomerEmail) && !empty($newCustomerPhone)) {
                    foreach ($customers as $id) {
                        $customer->updatePhone(intval($id), $newCustomerPhone);
                        echo('Numéro de téléphone mis à jour');
                    }
                //if email and phone are not empty
                } else {
                    foreach ($customers as $id) {
                        $customer->updateEmail(intval($id), $newCustomerEmail);
                        $customer->updatePhone(intval($id), $newCustomerPhone);
                        echo('Email et téléphone mis à jour');
                    }
                }
            //if no customer is checked, error message
            } else {
                echo('Vous devez sélectionner un client');
            }
        } catch (DomainException $e) {
            echo $e->getMessage();
        }
    }
}