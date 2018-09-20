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
        
        <h2>Stories! </h2>
        <br>
        <?php
            require 'database.php';
            $see_story = $mysqli->prepare("select title, body, author from stories order by id");
            if(!$see_story){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            
            $see_story->execute();
            $see_story->bind_result($title, $body, $author);
            
            echo "<ul id='stories'>\n";
            while($see_story->fetch()){
                echo "<li><h4>".$title;
                echo " <i> by ".$author."</i></h4><br>";
                echo $body. "<br><br><hr></li>";
            }
            echo "</ul>";
            
            $see_story->close();
            $mysqli->close();
        ?>
        
    </body>