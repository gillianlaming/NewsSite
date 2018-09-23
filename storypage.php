<!DOCTYPE HTML
<html lang="en">
	<head>
		<!--add a story to the turnip-->
		<meta charset="utf-8"/>
		<title>Title</title> 
		<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" href="../turnip.css">
	</head>
	<body>
		
		
	<?php
	require 'database.php';
	session_start();
	
	
	if(isset($_SESSION['name'])){ // if logged in
		$name = $_SESSION['name'];
		
		//this is a dummy article
		$title = "article title";
		$body = "this is the body of my story";
		$author = "fucktard";
		
		echo "<h1>".$title."</h1>";
		echo "<i>by: ".$author."</i></br></br>";
		echo "<i>".$body."</i></br></br></br>";
		
		?>
	
		
		<!--add comment to story-->
		<form action="addcomment.php" method="post">
		have thoughts on the article?
		<input type="submit" name="add_comment" value="Add Comment">
		</form>
		
		<?php
		//prints out all of the comments
		$see_comment = $mysqli->prepare("select comment_id, story_id, user, comment, comment_date from comments order by comment_id");
		if (!$see_comment){
			printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
		}
		
		$see_comment->execute();
		$see_comment->bind_result($comment_id, $story_id, $user, $comment, $comment_date);
		
		echo "<h2> Comments </h2><hr></li>";
		echo "</ul>";
		echo "<ul id='comments'>\n";
            while($see_comment->fetch()){
                //echo "<li><h4><a href='".$url."'>".$title."</a>";
                echo " <i> by ".$user."</i></h4><br>";
				//echo "<h6>".$comment_date."</h6>";
                echo $comment. "<br><br>";
				
				//if the user is the same as the author, story can be edited or deleted
				if (strcmp($user, $author) == 0){
					?>
					<!--delete comment from databse-->
					<form action="delete_comment.php" method="post">
						<input type="submit" name="delete_comment" value="Delete">
					</form>
					<form action="" method="post">
						<input type="submit" name="edit_comment" value="Edit">
					</form>
					
					<?php
					echo "<hr></li>";
					
				}
            }
            echo "</ul>";
            
            $see_comment->close();
            $mysqli->close();
		
		
			
		
	}
		?>
		

	
	</body>
</html>

