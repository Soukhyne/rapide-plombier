<?php

// test Post for contactEmail function
if (isset($_POST) && !empty($_POST)) {
    extract($_POST);
    //check if inputs are not empty and "politique de confidentialité" is checked
    if (!empty($nameNoJS) && !empty($phoneNoJS) && !empty($emailNoJS) && isset($politiqueNoJS)) {
        //check if name is OK with RegEx
        if (preg_match("%^[a-zA-ZÊÈÉÀéèêîïà][a-zéèêîïçà]+([-'\s][a-zA-ZÊÈÉÀéèêîïà][a-zéèêîïçà]+)?%", $nameNoJS)) {
            //check if phone is OK with RegEx
            if (preg_match("%[0-9]{10}%", $phoneNoJS)) {
                //check if email is OK with RegEx
                if (preg_match('%^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$%', $emailNoJS)) {
                    header('Location: ./../index.php?page=contactNoJS&?email=ok');
                    //the next step will be to send form on email through PHP but I would need a proper server.
                    //for this project, we will assume this is Ok and the email was sent.
                    exit();
                //error message
                } else {
                    header('Location: ./../index.php?page=contactNoJS&?email=notok');
                    exit();
                }
            //error message
            } else {
                header('Location: ./../index.php?page=contactNoJS&?phone=notok');
            exit();
            }
        //error message
        } else {
            header('Location: ./../index.php?page=contactNoJS&?name=notok');
            exit();
        }
    //error message
    } else {
        header('Location: ./../index.php?page=contactNoJS&?signup=empty');
        exit();
    }
}