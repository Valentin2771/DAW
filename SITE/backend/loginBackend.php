<?php

session_start();
if(isset($_SESSION['authenticated'])){
    // redirect the user on their page if already authenticated
    header('location: user.php'); 
    die;
}

require_once "config.php";
require_once "helper.php";

$username = $password = "";
$usernameError = $passwordError = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $username = sanitize($_POST['username']);
    $password = trim($_POST['password']);

    if(empty($username)){
        $usernameError = "User name can't be empty";
    }

    if(empty($password)){
        $passwordError = "Password can't be empty";
    }

    if(empty($usernameError) && empty($passwordError)){

        $sql = "SELECT id, first_name, last_name, username, role, password FROM users where username = :username";

        if($stmt = $connection->prepare($sql)){
            $stmt->bindParam(':username', $username);
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $user = $stmt->fetch();

                    if(password_verify($password, $user['password'])){
                        // session_start();
                        $_SESSION['authenticated'] = true;
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['id']= $user['id'];
                        $_SESSION['role'] = $user['role'];
                        $_SESSION['first_name'] = $user['first_name'];
                        $_SESSION['last_name'] = $user['last_name'];

                        header('location: user.php');
                    } else {
                        $passwordError = "Wrong password";
                        $username = "";
                        $password = "";
                    }
                } else{
                    $usernameError = "No such user";
                    $username = "";
                    $password = "";
                }
            }
        } else {
            echo "Something unexpected happened. Try again later.";
            $username = "";
            $password = "";
        }

        $stmt = null;
    }

    $connection = null;
}