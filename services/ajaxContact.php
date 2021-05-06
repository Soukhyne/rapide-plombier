<?php

// test Post for contactEmail function
if (isset($_POST) && !empty($_POST)) {
    extract($_POST);
    if (!empty($name) && !empty($phone) && !empty($email)) {
    //the next step will be to check and send the form on email through PHP but I would need a proper server.
    //for this project, we will assume this is Ok and the email was sent.
    echo ('true');
    }
}