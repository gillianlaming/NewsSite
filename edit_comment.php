<?php
	require ('database.php');
	$comment_id = $_POST['comment_id'];
	$comment=$_POST['comment'];
	
	?>
			<form action = "" method="post">
			Comment: <input type="text" id="commentbox" name="new_comment" value="<?php echo $comment; ?>"/><br/>
			<input type="submit" id="submit" name="submit" value="Submit">
			<input type="hidden" name="comment_id" value="<?php echo $comment_id ?>">
			<input type="hidden" name="comment" value="<?php echo $comment ?>">
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
		//$previous = "javascript:history.go(-3)";
		//if(isset($_SERVER['HTTP_REFERER'])) {
		//	$previous = $_SERVER['HTTP_REFERER'];
		//}
		
		
		echo "<a href=\"javascript:history.go(-2)\">GO BACK</a>";
		//header('Location: ../theturnip.php');
		//header('Location: ' . $_SERVER['HTTP_REFERER']);
		
	}
	
	?>
	
