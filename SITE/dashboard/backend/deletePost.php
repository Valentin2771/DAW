<?php
session_start();
require_once('../../backend/config.php');

if(!isset($_SESSION['authenticated']) && $_SESSION['role'] !== 'admin'){
    header('location: ../../user.php');
}

// echo "For admins only!";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(is_numeric($_GET['postid'])){
        $post_id = intval($_GET['postid']);
        $sql = "DELETE FROM posts WHERE id = :id";
        
        if($stmt = $connection->prepare($sql)){
            $stmt->bindParam(':id', $post_id);

            $stmt->execute();
        }
 
    }
}
$stmt = null;
$connection = null;
header('location: ../../user.php');
