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
        <html>
        
        <form action="" method="post">
        <input id="search" name="search" type="text" placeholder="Search stories">
        <input id="submit_search" name="submit_search" type="submit" value="Search">
        </form>
      
       
        <h2>Search Results</h2>

        <?php // display stories
            require 'database.php';
            session_start();
            
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
                        echo "<a href='".$url."'> title: ".$title."</a>";
                        echo "by ".$author."";
                        echo "this is the body" .$body. "<br><br>";
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
            <?php
            }
        ?>
        <br><br><br>
    </body>