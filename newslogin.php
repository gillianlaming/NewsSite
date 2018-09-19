<?php

    if (isset($_POST['submit'])) {      
        $name = $_POST["name"];
        $pass = $_POST["pass"];
        
        echo "hi " . $name . "<br>";
        echo "your hashed password is: " . password_hash($pass, PASSWORD_BCRYPT);
    }
    
?>