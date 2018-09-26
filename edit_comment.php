<?php
	require ('database.php');
	$comment_id = $_POST['comment_id'];
	$comment=$_POST['comment'];
	?>
			<form>
			Comment: <input type="text" id="commentbox" name="new_comment" method="post" value="<?php echo $comment; ?>"/><br/>
			<input type="submit" id="submit" name="submit" value="Submit">
			</form>
	<?php
	
	if (isset($_POST['submit'])){
		echo "hey";
		$new_comment = $_POST['new_comment'];
		$update = $mysqli->prepare("UPDATE comments SET comment= ? WHERE comment_id= ?");
		if (!$update){
			printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
			}
		echo "she worked";
		$update->bind_param('si', $new_comment, $comment_id);
		$update->execute(); 
		$update->close();
		
		header('Location: ../theturnip.php');
	}
	
	?>
	
