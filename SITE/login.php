<?php
require_once('backend/loginBackend.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/loginRegisterReset.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <h2>Login</h2>
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <input type="text" name="username" placeholder="User name"><br>
                <span class="red"><?php echo $usernameError; ?></span><br>
                <input type="password" name="password" placeholder="Password"><br>
                <span class="red"><?php echo $passwordError; ?></span><br>
                <input type="submit" value="Login"><br>
            </form>
        </div>
    </body>
</html>