<?php
    require database.php;
    if (isset($_POST['submit'])) {      
        $name = $_POST["name"];
        $pass = $_POST["pass"];
        
    
            // Content of database.php
            
            $mysqli = new mysqli('localhost', 'username', 'password_hash', 'news_site');
            
            if($mysqli->connect_errno) {
                printf("Connection Failed: %s\n", $mysqli->connect_error);
                exit;
            }
            
        
        echo "hi " . $name . "<br>";
        echo "your hashed password is: " . password_hash($pass, PASSWORD_BCRYPT);
        
        $stmt = $mysqli->prepare("insert into employees (first_name, last_name, department) values (?, ?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        
        $stmt->bind_param('sss', $first, $last, $dept);
        
        $stmt->execute();
        
        $stmt->close();
    }
    
?>