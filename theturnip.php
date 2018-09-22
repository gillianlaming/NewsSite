<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>The Turnip</title>
        <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <link rel="stylesheet" href="../turnip.css">
    </head>
    <body>
        <img src="../turnip.jpg" alt="turnip" width="25%">
        <h1>THE TURNIP</h1>
        <p>america's favorite news source for all things fucked up &amp; funky</p>
        
        <h2>Recent Stories</h2>

        <?php // display stories
            require 'database.php';
            $see_story = $mysqli->prepare("select id, title, body, story_date, author, url_id from stories order by id");
            if(!$see_story){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            
            $see_story->execute();
            $see_story->bind_result($story_id, $title, $body, $date, $author, $url);
            
            echo "<ul id='stories'>\n";
            while($see_story->fetch()){
                echo "<li><h4><a href='".$url."'>".$title."</a>";
                echo " <i> by ".$author."</i></h4> <h6>".$date."</h6>";
                echo $body. "<br><br><hr></li>";
            }
            echo "</ul>";
            
            session_start(); 

            if (isset($_SESSION['name'])){
                $name = $_SESSION['name'];
                
            ?>
            <div class="menu">
               <h3>hi <?php echo $name ?></h3>
                <a href="logout.php">Logout</a><br><br>
                <a href="addstory.php">Add Story</a>
            </div>
            <?php
            }
        ?>
        <br><br><br>
    </body>