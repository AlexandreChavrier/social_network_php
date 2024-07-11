<?php
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>ReSoC - Connexion</title> 
<meta name="author" content="Julien Falconnet">
<link rel="stylesheet" href="style.css"/>
</head>
<body>
<header>
    <a href="http://localhost/resoc/resoc_n1/admin.php"> 
        <img src="resoc.jpg" alt="Logo de notre réseau social"/>
    </a>
    <nav id="menu">
        <a href="news.php">Actualités</a><?php if (!empty($_SESSION['connected_id'])) { ?>
        <a href="wall.php?user_id=<?php echo $_SESSION['connected_id']?>">Mur</a>
        <a href="feed.php?user_id=<?php echo $_SESSION['connected_id']?>">Flux</a>
        <a href="tags.php?tag_id=1">Mots-clés</a><?php } ?>
    </nav>
    <nav id="user">
        <a href="#">Compte</a>
        <ul>
            <?php if (!empty($_SESSION['connected_id'])) { ?> 
            <li><a href="settings.php?user_id=<?php echo $_SESSION['connected_id']?>">Paramètres</a></li>
            <li><a href="followers.php?user_id=<?php echo $_SESSION['connected_id']?>">Mes suiveurs</a></li>
            <li><a href="subscriptions.php?user_id=<?php echo $_SESSION['connected_id']?>">Mes abonnements</a></li>
            <?php } ?>
            <li><a href="http://localhost/resoc/resoc_n1/login.php">Connexion</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
        </ul>
    </nav>
</header>
