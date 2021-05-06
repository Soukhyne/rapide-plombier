<?php
require_once './../models/Comment.php';
$newComment = new Comment;

if (isset($_GET) && !empty($_GET)) {
    extract($_GET); 
    if (isset($find) && $find === 'all') {
        //if GET exist and got the key/value : find/all, then go find all comments in database
        echo json_encode($newComment->findAll());
    }
} elseif (isset($_POST) && !empty($_POST)) {
    //if POST exist and there is no input "action"
    extract($_POST);
    if (!isset($action)) {
        if (!empty($lastName) && !empty($comment)) {
            //insert new comment if it's < 500 characters
            if (strlen($comment) < 500) {
                try {
                    //call insert method
                    $newComment->insertComment($lastName, $comment, date("Y-m-d"));
                } catch (DomainException $e) {
                    echo $e->getMessage();
                }
            }
        } else {
            echo('Veuillez remplir tous les champs');
        }
    //if POST exist and input "action" = delete
    } else if ($action === 'delete') {
        //var_dump($_POST); die;
        //delete one or more comments
        if (isset($comments)) {
            try {
                if(count($comments) > 0) {
                    foreach ($comments as $id) {
                        //call delete method
                        $newComment->delete(intval($id));
                    }
                    echo('Commentaire supprimé');
                    }
            } catch (DomainException $e) {
                echo $e->getMessage();
            }
        } else {
            echo('');
        }
    }
}