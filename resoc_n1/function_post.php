
<?php
$lesInformations = $mysqli->query($laQuestionEnSql);
if ( ! $lesInformations)
{
    echo("Échec de la requete : " . $mysqli->error);
}
    
while ($post = $lesInformations->fetch_assoc())
{
        // echo "<pre>" . print_r($post, 1) . "</pre>";
    ?>                
    <article>
        <h3>
            <time><?php 
                $mysqldate = $post['created'];
                setlocale(LC_TIME, 'fr_FR');
                $formattedDate = strftime('%e %B %Y à %H h %M', strtotime($mysqldate));
                echo($formattedDate);
            ?></time>
        </h3>
            <a href="http://localhost/resoc/resoc_n1/wall.php?user_id=<?php echo $post['user_id'] ?>">
                <address><?php echo $post['author_name'] ?></address> 
            </a>
        <div>
            <p><?php echo $post['content'] ?></p>
        </div>                                             
        <footer>
            <small>♥ <?php echo $post['like_number'] ?></small>
            <?php
            $tag_array = explode(";",(string)$post['taglist']);
            if (empty($post['taglist'])) 
            {
                echo '';
            } else {
            
                foreach ($tag_array as &$tags)
                {       
                    $tab = explode(",", $tags);
                    $tab_id = $tab[0];
                    $tab_label = $tab[1];
                    ?>
                    <a href="http://localhost/resoc/resoc_n1/tags.php?tag_id=<?php echo $tab_id ?>">#<?php echo $tab_label?></a>
                    <?php
                }
            }
                ?>

        </footer>
    </article>
<?php } ?>


<!-- http://localhost/resoc/resoc_n1/news.php -->