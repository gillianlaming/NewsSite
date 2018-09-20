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
		<br>
		
	
	<?php
	require 'database.php';
	session_start();
	
	if(isset($_SESSION['name'])){ // if logged in
		$name = $_SESSION['name'];
		echo "<h1>Hi, ".$name."</h1>";
		?>
		
		<h1>Add a Story to The Turnip</h1>
	
		<!--give story a title-->
		<form name="form" action="" method="post">
			<input type="text" name="title" id="title" placeholder="title"></br> 
			<input type="text" name="newstory" id="newstory"  placeholder="tell us something interesting">
			</br>
			<input type="submit" name="add_story" value="Add Story">
		</form>
		
		<?php
		
		if (isset($_POST['add_story'])){
			//obtain user so that story can be credited to them
			$title = $_POST['title'];
			$newstory = $_POST['newstory'];
	
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
	}
	else {
		echo "you are not logged in";
		echo "<br><a href='../newslogin.html'>Login or Register</a>";
	}

	?>
	
	</body>

</html>