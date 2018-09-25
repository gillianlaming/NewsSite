<?php
require 'database.php';

    $comment_id = $_POST['comment_id'];
		//delete from databse
	$delete = $mysqli->prepare("delete from comments where comment_id = ?");
    if (!$delete){
			printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
	}
	$delete->bind_param('i', $comment_id);
    $delete->execute(); 
    $delete->close();
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
