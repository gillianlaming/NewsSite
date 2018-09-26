<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
        <title>The Turnip: Edit Your Comment</title>
        <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <link rel="stylesheet" href="../turnip.css">
		</head>
		<!--sos we need comment_id-->
		<?php
		require ('database.php');
		$comment_id = $_POST['comment_id'];
		?>
		
		<body>
			<form action="" method="post">

			<input type="hidden" name="id" value="<?php echo $comment_id; ?>"/>
			</form>
			<p><strong>ID:</strong> <?php echo $comment_id; ?></p>
			<!--comment box needs to be bigger-->
			<strong>Comment: <input type="text" id="commentbox" name="comment" value="<?php echo $comment; ?>"/><br/>
			
			<input type="submit" name="submit" value="Submit">
			
			</form>

		</body>
	<?php
	include ('database.php');
	if (isset($_POST['submit'])){
		$comment = $_POST['comment']
		mysql_query("UPDATE comments SET comment='$comment' WHERE comment_id='$comment_id'")

		or die(mysql_error());

		$result = mysql_query("SELECT * FROM comments WHERE comment_id=$comment_id")
		
		or die(mysql_error());
		
		$row = mysql_fetch_array($result);
	
	if($row){
		$comment = $row['comment'];
	}
	else{
		echo "sad!";
	}
	}
	
	
	?>
	
</html>