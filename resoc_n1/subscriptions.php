
        <?php
            include("home_page.php");
        ?>
        <div id="wrapper">
            <aside>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez la liste des personnes dont
                        l'utilisatrice
                        n° <?php echo intval($_GET['user_id']) ?>
                        suit les messages
                    </p>

                </section>
            </aside>
            <main class='contacts'>
                <?php
                $userId = intval($_GET['user_id']);
                $mysqli = new mysqli("localhost", "root", "", "socialnetwork");
                $laQuestionEnSql = "
                    SELECT users.* 
                    FROM followers 
                    LEFT JOIN users ON users.id=followers.followed_user_id 
                    WHERE followers.following_user_id='$userId'
                    GROUP BY users.id
                    ";
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
                        <img src="user.jpg" alt="blason"/>
                        <h3><?php echo $user['alias'] ?></h3>
                        <p><?php echo $user['id'] ?></p>
                    </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>
