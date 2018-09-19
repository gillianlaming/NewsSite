<?php

  $mysqli = new mysqli('localhost', 'leela', '3250Trellis!', 'news_site');
 
  if($mysqli->connect_errno) {
      printf("Connection Failed: %s\n", $mysqli->connect_error);
      exit;
  }

?>