<?php
    session_start();
    if(!isset($_SESSION['authenticated'])){
        header('location: login.php');
        die;
    }

    require_once('backend/resetPasswordBackend.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reset Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/loginRegisterReset.css" rel="stylesheet">
    </head>
    <body>
        <h1>Welcome to the Change Password Page, <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];?>!</h1>
        <div class="wrapper">
            <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <input type="password" name="newPassword" placeholder="New Password"><br>
            <span><?php echo $newPasswordError; ?></span><br>
            <input type="password" name="confirmPassword" placeholder="Confirm password"><br>
            <span><?php echo $confirmPasswordError; ?></span><br>
            <input type="submit" value="Change"><br>
            </form>
        </div>
    </body>
</html>