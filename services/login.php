<?php
require_once './../models/User.php';
$user = new User;

if (isset($_GET) && !empty($_GET)) {
    extract($_GET);
    if (isset($action) && $action === 'logout') {
        //if GET exist and input action = logout
        session_start();
        unset($_SESSION);
        session_destroy();
        echo json_encode(['session' => null]);
    }
    
} elseif (isset($_POST) && !empty($_POST)) {
    //if POST exist and not empty
    extract($_POST);
    switch ($action) {
        //if input action = login
        case 'login':
            try {
                if(empty($userName) || empty($password)) {
                    throw new Exception('Merci de compléter tous les champs');
                } else {
                    //check on Database user and password
                    $userAuth = $user->auth($userName, $password);
                    if(count($userAuth) > 0) {
                        // Test Pwd
                        if(password_verify($password, $userAuth['password'])) {
                            if(session_status() === PHP_SESSION_NONE) {
                                //create session
                                session_start();
                                $_SESSION['id']     = $userAuth['id'];
                                $_SESSION['name']   = $userAuth['name'];
                                $_SESSION['email']  = $userAuth['email'];
                                $_SESSION['last_time'] = time();
                            }
                        } else {
                            throw new Exception('Erreur lors de l\'authentification');
                        }
                    } else {
                        throw new Exception('L\'utilisateur est inconnu'); 
                    }   
                } 
            } catch (Exception $e) {
                echo json_encode($e->getMessage());
            }
            break;
        //if input action = changeUser
        case 'changeUser':
            try {
                $id = intval($idSession);
                var_dump($id);
                var_dump($newEmail);
                var_dump($newPwd);
                //if password input is not empty and email is empty -> change only password
                if (!empty($pwd_confirm) && empty($email_confirm)) {
                    $userAuth = $user->changePassword($id, $newPwd);
                //if password input is empty and email is not empty -> change only email
                } elseif (empty($pwd_confirm) && !empty($email_confirm)) {
                    $user->changeEmail($id, $newEmail);
                //change password ans email
                } else {
                    $userAuth = $user->changeUser($id, $newPwd, $newEmail);
                }
            } catch (Exception $e) {
                echo json_encode($e->getMessage());
            }
            break;
    }
}