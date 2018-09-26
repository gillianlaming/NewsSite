<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>The Turnip</title>
        <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <link rel="stylesheet" href="../turnip.css">
    </head>
    
    <body>
        <img src="../turnip.jpg" alt="turnip" id="picture">
        <h1>THE TURNIP</h1>
        <p>america's favorite news source for all things fucked up &amp; funky</p>
        
        <form action="search_page.php" method="post">
        <input id="search" name="search" type="text" placeholder="Search stories">
        <input id="submit_search" name="submit_search" type="submit" value="Search">
        </form>
      
       
        <h2>Recent Stories</h2>

        <?php // display stories
            require 'database.php';
            session_start();
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
            
            $see_story->close();
           // $mysqli->close();
            
            if (isset($_POST['submit_search'])){
              $find_story = $_POST['search'];
              $search = $mysqli->prepare("select title, body, author, url_id from stories where title = ?");
                        if(!$find_story){
                          printf("Query Prep Failed: %s\n", $mysqli->error);
                          exit;
                          }
                
                $search->bind_param('s', $find_story);
                $search->execute();
                $search->bind_result($title, $body, $author, $url);
                
                //echo "<ul id='search results'>\n";
                while($search->fetch()){
                        echo "<li><h4><a href='".$url."'>".$title."</a>";
                        echo " <i> by ".$author."</i></h4>";
                        echo $body. "<br><br><hr></li>";
                    }  
                $search->close();
            }
            

            if (isset($_SESSION['name'])){ // if logged in, show options
                $name = $_SESSION['name'];
            
            
            ?>
            <div class="menu">
               <h3>hi <?php echo $name ?></h3>
                <a href="logout.php">Logout</a><br><br>
                <a href="addstory.php">Add Story</a>
            </div>
            <?php // if not logged in, only show login option
            } else { ?>
                <div class="menu">
                <a href="newslogin.html">Login</a>
                </div>
            <?php
            }
        ?>
        <br><br><br>
        </body>