<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>The Turnip</title>
        <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <link rel="stylesheet" href="../turnip.css">
    </head>
<?php
require ('database.php');
$see_comment = $mysqli->prepare("select comment_id, story_id, user, comment, comment_date from comments order by comment_id");
		if (!$see_comment){
			printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
		}
$see_comment->execute();
$see_comment->bind_result($comment_id, $story_id, $user, $comment, $comment_date);
$see_comment->close();

echo "you successfully made it";
//if(isset($_POST['delete_comment'])){
		//delete from databse
	$sql = "DELETE FROM comments WHERE comment_id=$comment_id";
	//there are two ways i found to delete: this is one
	mysqli_select_db('news_site');
            $retval = mysqli_query($sql, $mysqli);
            
            if(! $retval ) {
               die('Could not delete data: ' . mysql_error());
            }
            
            echo "Deleted data successfully\n";
            
	//and this is the other			
	if ($mysqli->query($sql) === TRUE) {
		echo "Record deleted successfully";
		} else {
		echo "Error deleting record: " . $mysqli->error;
		}

	
?>
</html>