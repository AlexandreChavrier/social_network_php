<?php
    include("home_page.php");
?>
<div id="wrapper">
    <?php
    $userId = intval($_GET['user_id']);
    ?>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "socialnetwork");
    ?>
    <aside>
        <?php
        $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
        $lesInformations = $mysqli->query($laQuestionEnSql);
        $user = $lesInformations->fetch_assoc();
        // echo "<pre>" . print_r($user, 1) . "</pre>";
        ?>
        <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
        <section>
            <h3>Présentation</h3>
            <p>Sur cette page vous trouverez tous les message de l'utilisatrice : <?php echo $user['alias'] ?>
            </p>

        </section>
    </aside>
    
    <main>
    <?php
    include("wallpost.php"); 
    ?>
    <?php

    $laQuestionEnSql = "
        SELECT posts.content, posts.created, users.alias as author_name,
        posts.user_id,
        tags.id as tags_id,
        COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.id, ',', tags.label SEPARATOR ';') AS taglist
        FROM posts
        JOIN users ON  users.id=posts.user_id
        LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
        LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
        LEFT JOIN likes      ON likes.post_id  = posts.id 
        WHERE posts.user_id='$userId' 
        GROUP BY posts.id
        ORDER BY posts.created DESC  
        ";
        ?> 
        <?php
        include("function_post.php");
        ?>
    </main>
</div>
</body>
</html>


<!-- modifier wall.php -->