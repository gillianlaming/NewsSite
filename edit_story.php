<?php
	require ('database.php');
	$story_id = $_POST['story_id'];
	$body=$_POST['body'];
	$url = $_POST['url'];
	
	?>
		<form action = "" method="post">
			Body: <input type="text" id="newstory" name="new_story" value="<?php echo $body; ?>"/><br/>
			<input type="submit" id="submit" name="submit" value="Update">
			<input type="hidden" name="story_id" value="<?php echo $story_id ?>">
			<input type="hidden" name="body" value="<?php echo $body ?>">
			<input type="hidden" name="url" value="<?php echo $url ?>">
		</form>
<?php

	if (isset($_POST['submit'])){
		$new_story = $_POST['new_story'];
		$update = $mysqli->prepare("UPDATE stories SET body = ? WHERE id = ?");
		if (!$update){
			printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
			}
		
		$update->bind_param('si', $new_story, $story_id);
		$update->execute(); 
		$update->close();
	
		header('Location: ..' . $url);
	}
	
?>
	
