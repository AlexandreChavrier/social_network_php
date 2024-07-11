
<?php 
include("home_page.php");
?> 
        <div id="wrapper" >

            <aside>
                <h2>Présentation</h2>
                <p>Bienvenu sur notre réseau social.</p>
            </aside>
            <main>
                <article>
                    <h2>Connexion</h2>
                    <?php
                    $enCoursDeTraitement = isset($_POST['email']);
                    if ($enCoursDeTraitement)
                    {

                        $emailAVerifier = $_POST['email'];
                        $passwdAVerifier = $_POST['motpasse'];
                        $mysqli = new mysqli("localhost", "root", "", "socialnetwork");
                        $emailAVerifier = $mysqli->real_escape_string($emailAVerifier);
                        $passwdAVerifier = $mysqli->real_escape_string($passwdAVerifier);
                        $passwdAVerifier = md5($passwdAVerifier);
                        // 1. On introduit la requête SQL
                        $lInstructionSql = "SELECT * "
                                . "FROM users "
                                . "WHERE "
                                . "email LIKE '" . $emailAVerifier . "'"
                                ;
                        // 2. On envoie la requête à la base de donnée
                        $res = $mysqli->query($lInstructionSql);
                        // 3. on récupère les données de la base SQL
                        $user = $res->fetch_assoc();
                        // echo "<pre>" . print_r($res, 1) . "</pre>";
                        if ( ! $user OR $user["password"] != $passwdAVerifier)
                        {
                            echo "La connexion a échouée. ";
                            
                        } else
                        {
                            echo "Votre connexion est un succès : " . $user['alias'] . ".";
                            $_SESSION['connected_id']=$user['id'];
                            header("Location: news.php");
                        }
                    }
                    ?>                     
                    <form action="login.php" method="post">
                        <input type='hidden'name='' value='achanger'>
                        <dl>
                            <dt><label for='email'>E-Mail</label></dt>
                            <dd><input type='email'name='email'></dd>
                            <dt><label for='motpasse'>Mot de passe</label></dt>
                            <dd><input type='password'name='motpasse'></dd>
                        </dl>
                        <input type='submit'>
                    </form>
                    <p>
                        Pas de compte ?
                        <a href='registration.php'>Inscrivez-vous.</a>
                    </p>

                </article>
            </main>
        </div>
    </body>
</html>
