<?php
    session_start();

    if(!isset($_SESSION['authenticated'])){
        header('Location: index.php');
        die;
    }

    require_once __DIR__."/backend/sendMailBackend.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">-->
    <link href="css/loginRegisterReset.css" rel="stylesheet">

    <title>Contact</title>
</head>
<body>
    <div class="wrapper">
        <h2>Contact form</h2>
        
        <form id="mail-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <label for="name">First and last name:</label><br>
            <input type="text" name="name" id="name" placeholder="Provide your full name" required><br>
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" placeholder="Provide a valid address" required><br>
            <label for="subject">Subject</label><br>
            <input type="text" name="subject" id="subject" placeholder="The subject you want to take up with us" required><br>
            <label for="content">Message</label><br>
            <textarea name="content" id="content" placeholder="Message up to 3000 characters" maxlength="3000"></textarea>
            <p class="red"><?php echo $mailError;?></p>
            <button>Send</button>
        </form>
        <a href="index.php" target="_self" class="button-link">First page</a>
    </div>
</body>
</html>