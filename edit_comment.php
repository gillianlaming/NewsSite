<?php
	require ('database.php');
	$comment_id = $_POST['comment_id'];
	$comment=$_POST['comment'];
	$url = $_POST['url'];
	
?>

	<head>
		<meta charset="utf-8"/>
        <title>Edit Comment</title>
        <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <link rel="stylesheet" href="../turnip.css">
	</head>
	<body>
		<br><br>
		<h1>Edit Your Comment</h1>
		<br>
		<form action = "" method="post">
			<input type="text" id="commentbox" name="new_comment" value="<?php echo $comment; ?>"/><br/>
			<input type="submit" id="submit" name="submit" value="Update">
			<input type="hidden" name="comment_id" value="<?php echo $comment_id ?>">
			<input type="hidden" name="comment" value="<?php echo $comment ?>">
			<input type="hidden" name="url" value="<?php echo $url ?>">
		</form>
	</body>

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
</html>
	
