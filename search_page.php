<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>The Turnip</title>
        <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <link rel="stylesheet" href="../turnip.css">
    </head>
    
    <body>
        <a href="../theturnip.php"><img src="../turniphome.jpeg" alt="turnip" id="icon"></a> 
		<br><br><br><br><br>
        <h2 id="search_results">Search Results</h2>

        <?php // display stories
            require 'database.php';
            session_start();
            
            if (isset($_POST['submit_search'])){
              $find_story = $_POST['search'];
              $search = $mysqli->prepare("select title, body, author, url_id from stories where title like ?");
                if(!$find_story){
                  printf("Query Prep Failed: %s\n", $mysqli->error);
                  exit;
                }
                $param = "%{$find_story}%";
                
                $search->bind_param('s', $param);
                $search->execute();
                $search->bind_result($title, $body, $author, $url);
                
                echo "<ul id='stories'>\n";
                echo "<br><p><strong>you searched for \"" . $find_story. "\"</strong><br>";
                while($search->fetch()){
                        echo "<li><h4><a href='".$url."'> ".$title."</a>";
                        echo " <i> by ".$author."</i></h4>";
                        echo $body. "<br><br><hr></li>";
                }
                echo "</ul>";
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
</html>