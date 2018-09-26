<?php
	// get story title and author from url
	$url = $_SERVER["REQUEST_URI"]; // get the current url path
	$title_and_author = str_replace("/storypage.php/","",$url); // isolate the title and author
	$plus = strpos($title_and_author, "+");
	$title = substr($title_and_author, 0, $plus);
	$author = substr($title_and_author, $plus+1, strlen($title_and_author));
?>


<!DOCTYPE HTML
<html lang="en">
	<head>
		<!--add a story to the turnip-->
		<meta charset="utf-8"/>
		<title><?php echo $title ?></title> 
		<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" href="../turnip.css">
	</head>
	<body>
		
		<a href="../theturnip.php"><img src="../turnip.jpg" alt="turnip" id="icon"></a> 
		
	<?php
		require 'database.php';
		session_start();
		
	if(isset($_SESSION['name'])){ // if logged in
			$name = $_SESSION['name'];
			
			// get body of story from database
			$get_story = $mysqli->prepare("select id, body, story_date from stories where url_id = ?");
			if (!$get_story){
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
			$get_story->bind_param("s", $url);
			$get_story->execute();
			$get_story->bind_result($story_id, $body, $story_date);
			$get_story->fetch();
			
			
			echo "<br><h1>".$title."</h1>";
			echo "by: <i>".$author."</i><br><h6>".$story_date."</h6></br>";
			echo "<p id='story_body'>".$body."</p></br></br></br>";
			
			$get_story->close();
	?>

		<!--add comment to story-->
		<form action="" method="post" id="addform">
		have thoughts on the story?
		<input type="text" name="comment" id="comment" placeholder="add comment here">
		<input type="submit" name="add_comment" value="Post">
		</form>
		
	<?php
		
		if(isset($_POST['add_comment'])){
			$comment = $_POST['comment'];
			$add_comment = $mysqli->prepare("insert into comments (user, comment, story_id) values(?, ?, ?)");
			if(!$add_comment){
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
			
			$add_comment->bind_param('ssi', $name, $comment, $story_id); /*adds the author, comment, and id*/
			$add_comment->execute();
			$add_comment->close();
		}

		//prints out all of the comments
		$see_comment = $mysqli->prepare("select comment_id, user, comment, comment_date from comments where story_id = ? order by comment_id");
		if (!$see_comment){
			printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
		}
		
		$see_comment->bind_param("i", $story_id); // only get comments from this particular story
		$see_comment->execute();
		$see_comment->bind_result($comment_id, $user, $comment, $comment_date);
		
		echo "<h2 id='label'> Comments </h2>";

		echo "<ul id='comments'>";
		while($see_comment->fetch()){
			echo "<li><strong>".$user."</strong>: ";
			echo "<i>".$comment. "</i><br><br>";
			
			//if the user is the same as the person logged in, story can be edited or deleted
			if (strcmp($user, $name) == 0){
				?>
				<!--delete comment from databse-->
				<form action="../delete_comment.php" method="post">
					<input type="submit" name="delete_comment" value="Delete">
					<input type="hidden" name="comment_id" value="<?php echo $comment_id ?>">
				</form>
				<form action="../edit_comment.php" method="post">
					<input type="submit" name="edit_comment" value="Edit">
					<input type="hidden" name="comment_id" value="<?php echo $comment_id ?>">
				</form><br></li>
				
				<?php
			}
		}
		echo "</ul>";
		
		$see_comment->close();
		$mysqli->close();
		
	} else {
		echo '<div class="menu"><a href="../newslogin.html">Login</a>';
	}
?>

	</body>
</html>

