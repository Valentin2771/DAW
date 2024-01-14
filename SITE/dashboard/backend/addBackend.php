<?php
session_start();
if(!(isset($_SESSION['authenticated']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'writer'))){
    header('location: ../login.php');
    die;
}

// These includes will also work after including in add.php

require_once "../backend/config.php";
require_once "../backend/helper.php";


// We need to populate the picture table

$sql = "SELECT * from pics";
$stmt = $connection->query($sql);
$pictures = $stmt->fetchAll();
$sql = $stmt = null;

$title = $content = $public = "";
$titleError = $contentError = $pictureError = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = sanitize($_POST['title']);
    $content = $_POST['content'];
    $public = $_POST['public'];
    $picture_id = $_POST['picture_id'];

    if(empty($title)){
        $titleError = "Title field can't be empty";
    }

    if(empty($content)){
        $contentError = "Content field can't be empty";
    }

    if(empty($picture_id)){
        $pictureError = "Picture id field can't be empty";
    }

    if(empty($titleError) && empty($contentError) && empty($pictureError)){
        $sql = "INSERT INTO posts (post_title, post_content, author_id, picture_id, public) VALUES(:post_title, :post_content, :author_id, :picture_id, :public)";

        if($stmt = $connection->prepare($sql)){
            $stmt->bindParam(':post_title', $title);
            $stmt->bindParam(':post_content', $content);
            $stmt->bindParam(':author_id', $_SESSION['id']);
            $stmt->bindParam(':picture_id', $picture_id);
            $stmt->bindParam(':public', $public);
            // User redirected to Add page after publishing an article
            if($stmt->execute()){
                header('location: add.php');
                die;
            } else {
                echo "Something unexpected happened. No posts were added to database.";
            }
        }
        $stmt = null;
        $connection = null;
    }
}