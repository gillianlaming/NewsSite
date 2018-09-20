<!DOCTYPE HTML
<html lang="en">
	<head>
		<!--add a story to the turnip-->
		<meta charset="utf-8"/>
		<title>The Turnip: Add a Story</title>
		<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" href="../turnip.css">
	</head>
	<body>
		<h1>Add a Story</h1>
	
	<!--give story a title-->
	<form name="form" action="" method="post">
		Title:
		<input type="text" name="title" id="title">
		Story:
		<input type="text" name="newstory" id="newstory">
		
		<input type="submit" name="add_story" value="Add Story">
	</form>
	
	<?php
	require 'database.php';
	
	if(isset($_POST['add_story'])){ /*i do not think this is the right command*/
	
		//obtain user so that sotry can be credited to them
		$name = 'leela';
		$title = $_POST['title'];
		$newstory = $_POST['newstory'];
		//$_POST["name"]; /*gets username*/
		$add_story = $mysqli->prepare("insert into stories (title, body, author) values(?, ?, ?)");
		if(!$add_story){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		
		$add_story->bind_param('sss', $title, $newstory, $name); /*adds the title, body, and author*/
		$add_story->execute();
		$add_story->close();
		
		echo "good news! your story has been posted!";
	}
		//echo "<p style=\"width: 50%; margin-left: 25%;\"> <br>"; //styling
	?>
	<br>
	<a href="../theturnip.php">Home</a>
	</body>

</html>