
        <?php
            include("home_page.php");
        ?>
        <div id="wrapper">
            <?php

            $tagId = intval($_GET['tag_id']);
            ?>
            <?php
 
            $mysqli = new mysqli("localhost", "root", "", "socialnetwork");
            ?>

            <aside>
                <?php
      
                $laQuestionEnSql = "SELECT * FROM tags WHERE id= '$tagId' ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $tag = $lesInformations->fetch_assoc();
                // echo "<pre>" . print_r($tag, 1) . "</pre>";
                ?>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez les derniers messages comportant
                        le mot-clé <?php echo $tag["label"];?>
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
                    FROM posts_tags as filter 
                    JOIN posts ON posts.id=filter.post_id
                    JOIN users ON users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE filter.tag_id = '$tagId' 
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