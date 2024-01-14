<?php 
require_once("backend/indexBackend.php");
?>

<!DOCTYPE html>
<html lang="RO">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Jack Asylum</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link href="css/indexStyle.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1 class="blue"><a href="index.php">Bine ați venit la azilul lui Blue Jack</a></h1>
        <hr>
        <nav>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </nav>
    </header>
    <main>
        <section id="all-stories">
        <h2>Toate titlurile</h2>
        <?php
            try{
                if(!isset($posts)){
                    throw new Exception("Something wrong happened...<br>");
                    
                } else {

                    for($i = 0; $i < count($posts); $i++) {
                        echo'
                        <article class="one-third">
                            <h3 class="blue">
                                <a href="post.php?id='. $posts[$i]['id'] .'&page='. $pageNumber . '">' . $posts[$i]['post_title']. '</a>
                            </h3>
                            <div class="post-img">
                                <img src="img/' . $posts[$i]['name'] . '" alt="post image">
                            </div>
                            <p>' . mb_strimwidth($posts[$i]['post_content'], 0, 100, '...') . '
                            </p>
                            <p class="author">Author: ' . $posts[$i]['first_name'] . ' ' . $posts[$i]['last_name'] . ' &bull; ' . $posts[$i]['created_at'] . '</p>
                            <a href="post.php?id='. $posts[$i]['id'] .'">More</a>
                        </article>
                            ';
                        // We need to clearfix after each line of three articles or at the end of the last article
                        // in order to avoid unwanted floating effects
                        if((($i + 1 != 0) && (($i + 1) % 3 == 0)) || $i == count($posts) - 1) echo '<div class="clearfix"></div>';
                    }
                }
            } catch(Exception $e) {
                echo $e->getMessage();
            }
            
        ?>
        </section>
        <div id="pagination">
            <a href="index.php?page=<?php echo ($pageNumber - 1); ?>"><button <?php if($pageNumber - 1 <= 0) echo 'disabled'; ?>>Previous page</button></a>
            <a href="index.php?page=<?php echo ($pageNumber + 1); ?>"><button>Next page</button></a>
        </div>
    </main>
    <footer>
            <section id="footer-content">
                <p>Contact <a href="mailto:valentin.iclozan27@gmail.com">via e-mail</a></p>
                <p>Acesta este un proiect școlar, care a avut în vedere respectarea condițiilor de copyright. Fotografiile utilizate sunt preluate din <a href="https://pixabay.com/" target="_blank"> surse gratuite</a>. Întreg codul a fost scris, modificat și testat de studentul <a href="https://adrian2771.github.io/studyproject/">Adrian Valentin Iclozan</a></p>

            </section>
    </footer>
</body>
</html>