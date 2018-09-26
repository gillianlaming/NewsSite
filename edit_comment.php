<?php
	require ('database.php');
	$comment_id = $_POST['comment_id'];
	$comment=$_POST['comment'];
	$url = $_POST['url'];
	
?>
	<form action = "" method="post">
		Comment: <input type="text" id="commentbox" name="new_comment" value="<?php echo $comment; ?>"/><br/>
		<input type="submit" id="submit" name="submit" value="Submit">
		<input type="hidden" name="comment_id" value="<?php echo $comment_id ?>">
		<input type="hidden" name="comment" value="<?php echo $comment ?>">
		<input type="hidden" name="url" value="<?php echo $url ?>">
	</form>
<?php

	if (isset($_POST['submit'])){
		
		$new_comment = $_POST['new_comment'];
		$update = $mysqli->prepare("UPDATE comments SET comment = ? WHERE comment_id = ?");
		if (!$update){
			printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
			}
		
		$update->bind_param('si', $new_comment, $comment_id);
		$update->execute(); 
		$update->close();
	
		header('Location: ..' . $url);

	}
	
?>
	
