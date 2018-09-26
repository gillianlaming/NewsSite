<?php
require 'database.php';

    $story_id = $_POST['story_id'];
		//delete from databse
    $delete_comments = $mysqli->prepare("delete from comments where story_id = ?");
    if (!$delete_comments){
			printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
	}
	$delete_comments->bind_param('i', $story_id);
    $delete_comments->execute(); 
    $delete_comments->close();
    
	$delete = $mysqli->prepare("delete from stories where id = ?");
    if (!$delete){
			printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
	}
	$delete->bind_param('i', $story_id);
    $delete->execute(); 
    $delete->close();
    
   header('Location: ../theturnip.php');
?>
