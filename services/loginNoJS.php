<?php
require_once './../models/User.php';
$user = new User;

if (isset($_POST) && !empty($_POST)) {
    //if POST exist and not empty
    extract($_POST);
    //print_r($_POST); die;
    switch ($action) {
        //if input action = login
        case 'login':
            if(empty($userNameNoJS) || empty($passwordNoJS)) {
                header('Location: ./../view/views/authNoJS.php?signup=empty');
                exit();
            } else {
                try {
                    //check on Database user and password
                    $userAuth = $user->auth($userNameNoJS, $passwordNoJS);
                    if(count($userAuth) > 0) {
                        // Test Pwd
                        if(password_verify($passwordNoJS, $userAuth['password'])) {
                            if(session_status() === PHP_SESSION_NONE) {
                                //create session
                                session_start();
                                $_SESSION['id']     = $userAuth['id'];
                                $_SESSION['name']   = $userAuth['name'];
                                $_SESSION['email']  = $userAuth['email'];
                                $_SESSION['last_time'] = time();
                                header('Location: ./../view/views/administrateurNoJS.php');
                            exit();
                            }
                        } else {
                            header('Location: ./../view/views/authNoJS.php?signup=fail');
                            exit();
                        }
                    } else {
                        header('Location: ./../view/views/authNoJS.php?signup=name');
                        exit(); 
                    }   
                } catch (Exception $e) {
                    header('Location: ./../view/views/authNoJS.php?signup=fail');
                    exit();;
                }
            }
            break;
        //if input action = changeUser
        case 'changeUser':
            if ((!empty($newPwdNoJS) && !empty($pwd_confirmNoJS)) || (!empty($newEmailNoJS) && !empty($email_confirmNoJS))) {
                try {
                    $id = intval($idSession);
                    if (!empty($pwd_confirmNoJS) && empty($email_confirmNoJS)) {
                        //verif si pwd = pwd
                        if ($newPwdNoJS === $pwd_confirmNoJS) {
                            //verif si pwd  = regex
                            if (preg_match("%^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!\%*?&])[A-Za-z\d@$!\%*?&]{8,}$%", $newPwdNoJS)) {
                                $userAuth = $user->changePassword($id, $newPwdNoJS);
                                header('Location: ./../view/views/administrateurNoJS.php?pwd=ok');
                                exit();
                            } else {
                                //sinon erreur
                                header('Location: ./../view/views/administrateurNoJS.php?pwd=regex');
                                exit();
                            }
                        } else {
                            //sinon error message
                            header('Location: ./../view/views/administrateurNoJS.php?pwd=notok');
                            exit();
                        }
                    } elseif (empty($pwd_confirmNoJS) && !empty($email_confirmNoJS)) {
                        //verif si email = email
                        if ($newEmailNoJS === $email_confirmNoJS) {
                            //verif si email  = regex
                            if (preg_match('%^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$%', $newEmailNoJS)) {
                                //print_r('email OK'); die;
                                $user->changeEmail($id, $newEmailNoJS);
                                header('Location: ./../view/views/administrateurNoJS.php?email=ok');
                                exit();
                            } else {
                                //print_r('email PAS OK'); die;
                                //sinon erreur
                                header('Location: ./../view/views/administrateurNoJS.php?email=regex');
                                exit();
                            }
                        } else {
                            //sinon error message
                            header('Location: ./../view/views/administrateurNoJS.php?email=notok');
                            exit();
                        }
                    } elseif (!empty($pwd_confirmNoJS) && !empty($email_confirmNoJS)) {
                        //verif si email = email et pwd = pwd
                        if ($newPwdNoJS === $pwd_confirmNoJS && $newEmailNoJS === $email_confirmNoJS) {
                            //verif si email  = regex
                            if (preg_match('%^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$%', $newEmailNoJS)) {
                                //verif si pwd = regex
                                if (preg_match("%^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!\%*?&])[A-Za-z\d@$!\%*?&]{8,}$%", $newPwdNoJS)) {
                                    $user->changeEmail($id, $newEmailNoJS);
                                    $user->changePassword($id, $newPwdNoJS);
                                    header('Location: ./../view/views/administrateurNoJS.php?all=ok');
                                    exit();
                                } else {
                                    header('Location: ./../view/views/administrateurNoJS.php?pwd=regex');
                                    exit();
                                }
                            } else {
                                header('Location: ./../view/views/administrateurNoJS.php?email=regex');
                                exit();
                            }
                        } 
                    }
                } catch (Exception $e) {
                    header('Location: ./../view/views/administrateurNoJS.php?erreur=ok');
                    exit();;
                }
            } else {
                header('Location: ./../view/views/administrateurNoJS.php?inputs=empty');
                exit();
            }
            break;
        case 'logout':
            session_start();
            unset($_SESSION);
            session_destroy();
            header('Location: ./../index.php');
            break;
    }
}