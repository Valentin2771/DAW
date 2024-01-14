<?php

require_once("config.php");
require_once("helper.php");

$first_name = $last_name = $username = $password = $confirmPassword = "";
$usernameError = $passwordError = $confirmPasswordError = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $first_name = sanitize($_POST['first_name']);
    $last_name = sanitize($_POST['last_name']);
    $username = sanitize($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    // check username
    if(empty($username)){
        $usernameError = "User name field can't be left empty";
    } else {
    
        $sql = "select id from users where username = :username";
    
        // check if the chosen user name already in the data base
        if($stmt = $connection->prepare(($sql))){
            $stmt->bindParam(":username", $username);
    
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $usernameError = "User name already in use. Try another one";
                    $username = "";
                } // if unsername not in the data base, $username  won't be empty
            } else {
                echo "Something unexpected happened";
            }
        }
        $stmt = null;  
    }
    
    // check password
    if(empty($password)){
        $passwordError = "Password can't be empty.";
    } else if (strlen($password) < 8){
        $passwordError = "Password must be at least eight characters long";
        $password = "";
    }

    // check retyped password
    if(empty($confirmPassword)){
        $confirmPasswordError = "Retyped password can't be empty.";
    } else if (strcmp($confirmPassword, $password) != 0){
        $confirmPasswordError = "Retyped password doesn't match.";
        $confirmPassword = "";
        $password = "";
    }

    // if all error messages are empty, we can go further and insert the first name and the last name,
    // as well as the username and the password in the database
    if(empty($usernameError) && empty($passwordError) && empty($confirmPasswordError)){
        $sql = "INSERT into users (first_name, last_name, username, password) VALUES(:first_name, :last_name, :username, :password)";
        if($stmt = $connection->prepare($sql)){
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(":password", $hashedPassword);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":first_name", $first_name);
            $stmt->bindParam(":last_name", $last_name);
        }

        if($stmt->execute()) {
           header("location: login.php");
        } else {
            echo "Something unexpected happened.";
        }

        $stmt = null;
    }
    $connection = null;
}



