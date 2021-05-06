<?php
require_once './../models/Customer.php';
$customer = new Customer;
 
// if POST exist and not empty
if (isset($_POST) && !empty($_POST)) {
    $action = htmlspecialchars($_POST['action']);
    $nameCustomerNoJS = htmlspecialchars($_POST['nameCustomerNoJS']);
    $firstnameCustomerNoJS = htmlspecialchars($_POST['firstnameCustomerNoJS']);
    $emailCustomerNoJS = htmlspecialchars($_POST['emailCustomerNoJS']);
    $phoneCustomerNoJS = htmlspecialchars($_POST['phoneCustomerNoJS']);
    $nameSearchNoJS = htmlspecialchars($_POST['nameSearchNoJS']);
    $newCustomerEmailNoJS = htmlspecialchars($_POST['newCustomerEmailNoJS']);
    $newCustomerPhoneNoJS = htmlspecialchars($_POST['newCustomerPhoneNoJS']);
    //if input action = newCustomer, add a new one
    if ($action === "newCustomer") {
        try {
            if (!empty($nameCustomerNoJS) && !empty($firstnameCustomerNoJS) && !empty($emailCustomerNoJS) && !empty($phoneCustomerNoJS)) {
                //check if customer already exist in Database.
                if ($newCustomer = $customer->findByEmail($_POST['emailCustomerNoJS'])) {
                    //error message
                    header('Location: ./../view/views/administrateurNoJS.php?customer=already');
                    exit();
                } else {
                    //call insert method
                    $customer->insertCustomer($nameCustomerNoJS, $firstnameCustomerNoJS, $emailCustomerNoJS, $phoneCustomerNoJS);
                    header('Location: ./../view/views/administrateurNoJS.php?newcustomer=OK');
                    exit();
                }
            } else {
                //error message
                header('Location: ./../view/views/administrateurNoJS.php?namecust=empty');
                exit();
            }
        } catch (DomainException $e) {
            //error message
            header('Location: ./../view/views/administrateurNoJS.php?newcustomer=error');
            exit();
        }
    //if input action = changeCustomer
    } elseif ($action === 'changeCustomer') {
        //update a customer
        if (isset($nameSearchNoJS) && !empty($nameSearchNoJS)) {
            if (!empty($customer->findByName($nameSearchNoJS))) {
                //if email is not empty AND phone is empty
                if (!empty($newCustomerEmailNoJS) && empty($newCustomerPhoneNoJS)) {
                    $customer->updateEmailNoJS($nameSearchNoJS, $newCustomerEmailNoJS);
                    header('Location: ./../view/views/administrateurNoJS.php?email=changed');
                    exit();
                //if email is empty AND phone is not empty
                } elseif (empty($newCustomerEmailNoJS) && !empty($newCustomerPhoneNoJS)) {
                    $customer->updatePhoneNoJS($nameSearchNoJS, $newCustomerPhoneNoJS);
                    header('Location: ./../view/views/administrateurNoJS.php?phone=changed');
                    exit();
                //if email and phone are not empty
                } elseif(!empty($newCustomerEmailNoJS) && !empty($newCustomerPhoneNoJS)) {
                    $customer->updateEmailNoJS($nameSearchNoJS, $newCustomerEmailNoJS);
                    $customer->updatePhoneNoJS($nameSearchNoJS, $newCustomerPhoneNoJS);
                    header('Location: ./../view/views/administrateurNoJS.php?all=changed');
                    exit();
                } else {
                    //error message
                    header('Location: ./../view/views/administrateurNoJS.php?allinput=empty');
                    exit();
                }
            } else {
                //error message
                header('Location: ./../view/views/administrateurNoJS.php?customer=notknow');
                exit();
            }
        } else {
            //error message
            header('Location: ./../view/views/administrateurNoJS.php?namecustomer=notfill');
            exit();
        }
    }
}