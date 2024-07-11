<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Administration</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>
            <img src="resoc.jpg" alt="Logo de notre réseau social"/>
                <nav id="menu">
                    <a href="news.php">Actualités</a>
                    <a href="wall.php?user_id=5">Mur</a>
                    <a href="feed.php?user_id=5">Flux</a>
                    <a href="tags.php?tag_id=1">Mots-clés</a>
                </nav>
                <nav id="user">
                    <a href="#">Profil</a>
                <ul>
                    <li><a href="settings.php?user_id=5">Paramètres</a></li>
                    <li><a href="followers.php?user_id=5">Mes suiveurs</a></li>
                    <li><a href="subscriptions.php?user_id=5">Mes abonnements</a></li>
                </ul>
            </nav>
    </header>
        <?php
        $mysqli = new mysqli("localhost", "root", "", "socialnetwork");
        if ($mysqli->connect_errno)
        {
            echo("Échec de la connexion : " . $mysqli->connect_error);
            exit();
        }
        ?>
        <div id="wrapper" class='admin'>
            <aside>
                <h2>Mots-clés</h2>
                <?php
                $laQuestionEnSql = "SELECT * FROM `tags` LIMIT 50";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                    exit();
                }

                while ($tag = $lesInformations->fetch_assoc())
                {
                    ?>
                    <article>
                        <h3><?php echo $tag['label'] ?></h3>
                        <p><?php echo $tag['id'] ?></p>
                        <nav>
                        <a href="http://localhost/resoc/resoc_n1/tags.php?tag_id=<?php echo $tag['id'] ?>">Messages</a>
                        </nav>
                    </article>
                <?php } ?>
            </aside>
            <main>                   
                <h2>Utilisatrices</h2>
                <?php
                $laQuestionEnSql = "SELECT * FROM `users` LIMIT 50";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                    exit();
                }

                while ($user = $lesInformations->fetch_assoc())
                {
                    ?>
                    <article>
                        <h3><?php echo $user['alias'] ?></h3>
                        <p><?php echo $user['id'] ?></p>
                        <nav>
                            <a href="http://localhost/resoc/resoc_n1/wall.php?user_id=<?php echo $user['id'] ?>">Mur</a>
                            | <a href="http://localhost/resoc/resoc_n1/feed.php?user_id=<?php echo $user['id'] ?>">Flux</a>
                            | <a href="http://localhost/resoc/resoc_n1/settings.php?user_id=<?php echo $user['id'] ?>">Paramètres</a>
                            | <a href="http://localhost/resoc/resoc_n1/followers.php?user_id=<?php echo $user['id'] ?>">Suiveurs</a>
                            | <a href="http://localhost/resoc/resoc_n1/subscriptions.php?user_id=<?php echo $user['id'] ?>">Abonnements</a>
                        </nav>
                    </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>

<!-- http://localhost/resoc/resoc_n1/news.php -->