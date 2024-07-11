
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
        ?>
        <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
        <section>
            <h3>Présentation</h3>
            <p>Sur cette page vous trouverez tous les message des utilisatrices
                auxquel est abonnée l'utilisatrice <?php echo $user['alias'];?>
            </p>
        </section>
    </aside>
    <main>
        <?php
        $laQuestionEnSql = "
            SELECT posts.content,
            posts.created,
            posts.user_id,
            tags.id as tags_id,
            users.alias as author_name,  
            count(likes.id) as like_number,  
            GROUP_CONCAT(DISTINCT tags.id, ',', tags.label SEPARATOR ';') AS taglist
            FROM followers 
            JOIN users ON users.id=followers.followed_user_id
            JOIN posts ON posts.user_id=users.id
            LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
            LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
            LEFT JOIN likes      ON likes.post_id  = posts.id 
            WHERE followers.following_user_id='$userId' 
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
