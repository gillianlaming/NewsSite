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
			
			<div>
			
			<p><strong>ID:</strong> <?php echo $comment_id; ?></p>
			<!--comment box needs to be bigger-->
			<strong>Comment: </strong> <input type="text" name="firstname" value="<?php echo $comment; ?>"/><br/>
			
			<input type="submit" name="submit" value="Submit">
			
			</div>
			
			</form>

		</body>
	<?php
	include ('database.php');
	if (isset($_POST['submit'])){
		mysql_query("UPDATE comments SET comment='$comment' WHERE comment_id='$comment_id'")

		or die(mysql_error());
		
		$comment_id = $_GET['comment_id'];

		$result = mysql_query("SELECT * FROM comments WHERE comment_id=$comment_id")
		
		or die(mysql_error());
		
		$row = mysql_fetch_array($result);
	}
	if($row){
		$comment = $row['comment'];
	}
	else{
		echo "sad!";
	}
	
	
	?>
	
</html>