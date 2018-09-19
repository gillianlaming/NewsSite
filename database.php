<?php

 $mysqli = new mysqli('localhost', 'username', 'password_hash', 'news_site');
            
            if($mysqli->connect_errno) {
                printf("Connection Failed: %s\n", $mysqli->connect_error);
                exit;
            }

?>