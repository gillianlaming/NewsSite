<?php
    require 'database.php';
    if (isset($_POST['submit'])) {      
        $name = $_POST["name"];
        $pass = $_POST["pass"];

        echo "hi " . $name . "<br>";
        $hash = password_hash($pass, PASSWORD_BCRYPT);
        echo "your hashed password is: " . $hash . "<br>";
        
        $stmt = $mysqli->prepare("insert into users (username, password_hash) values (?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        
        $stmt->bind_param('ss', $name, $hash);
        
        $stmt->execute();
        
        $stmt->close();
    }
    
?>