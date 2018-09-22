!DOCTYPE HTML
<html lang="en">
	<head>
		<!--add a comment to a story in the turnip-->
		<meta charset="utf-8"/>
		<title>The Turnip: Add a Comment</title>
		<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" href="../turnip.css">
	</head>
	<body>
		<h1>Add a Comment</h1>
	
	<!--give story a title-->
	<form name="form" action="" method="post">
		Comment:
		<input type="text" name="comment" id="comment">
		<input type="submit" name="add_comment" value="Add Comment">
	</form>
	
	<?php
	require 'database.php';
	
	if(isset($_POST['add_comment'])){ 
	
		session_start();
		//obtain user so that comment can be credited to them
		$name = $_SESSION['name'];
		$storyid = '1';
		$comment = $_POST['comment'];
		$add_comment = $mysqli->prepare("insert into stories (user, comment, story_id) values(?, ?, ?)");
		if(!$add_comment){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		
		$add_comment->bind_param('ssi', $name, $comment, $storyid); /*adds the title, body, and author*/
		$add_comment->execute();
		$add_comment->close();
		
		echo "good news! your comment has been posted!";
	}
		
	?>
	<br>
	<a href="../theturnip.php">Home</a>
	</body>

</html>