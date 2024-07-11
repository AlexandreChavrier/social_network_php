
<article>
    <h2>Poster un message</h2>
        <form action="wall.php?user_id=<?php echo $user["id"]?>" method="post">
            <input type='hidden' name='message' value=''>
            <dl>
                <dt><label for='message'>Message</label></dt>
                <dd><textarea name='message'></textarea></dd>
            </dl>
            <input type='submit'>
        </form> 
 <?php

    $enCoursDeTraitement = isset($_POST['message']);
    if ($enCoursDeTraitement)
    {

        $authorId = $user['id'];
        $postContent = $_POST['message'];

        $authorId = intval($mysqli->real_escape_string($authorId));
        $postContent = $mysqli->real_escape_string($postContent);
      
        $lInstructionSql = "INSERT INTO posts "
                . "(id, user_id, content, created, parent_id) "
                . "VALUES (NULL, "
                . $authorId . ", "
                . "'" . $postContent . "', "
                . "NOW(), "
                . "NULL); "
                ;
        
        
        $ok = $mysqli->query($lInstructionSql);
        if ( ! $ok)
        {
            echo "Impossible d'ajouter le message: " . $mysqli->error;
        } else
        {
            echo "Message posté en tant que : " . $user['alias'];
        }
    }
    ?>                                   
</article>

