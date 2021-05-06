<?php
require_once './../models/Comment.php';
$newComment = new Comment;

if (isset($_POST) && !empty($_POST)) {
    //if POST exist and there is no input "action"
    extract($_POST);
    if (!isset($action)) {
        //if inputs name and comment are not empty
        if (!empty($lastNameNoJS) && !empty($commentNoJS)) {
            //insert new comment if it's < 500 characters
            if (strlen($commentNoJS) < 500) {
                try {
                    //call insert method
                    $newComment->insertComment($lastNameNoJS, $commentNoJS, date("Y-m-d"));
                    header('Location: ./../index.php?page=commentairesNoJS&?comment=ok');
                    exit();
                } catch (DomainException $e) {
                    //error message
                    header('Location: ./../index.php?page=commentairesNoJS&?comment=error');
                    exit();
                }
            } else {
                //error message
                header('Location: ./../index.php?page=commentairesNoJS&?comment=long');
                exit();
            }
        } else {
            //error message
            header('Location: ./../index.php?page=commentairesNoJS&?signup=empty');
            exit();
        }
    //if POST exist and input "action" = delete
    } else if ($action === 'delete') { 
        //delete one or more comments
        if (isset($comm)) {
            try {
                if(count($comm) > 0) {
                    foreach ($comm as $id) {
                        //call delete method
                        $newComment->delete(intval($id));
                    }
                    header('Location: ./../view/views/administrateurNoJS.php?delete=ok');
                    exit();
                }
            } catch (DomainException $e) {
                header('Location: ./../view/views/administrateurNoJS.php?delete=notok');
                exit();
            }
        } else {
            //error message
            header('Location: ./../view/views/administrateurNoJS.php?input=empty');
            exit();
        }
    }
}