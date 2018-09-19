<?php
    require 'database.php';
    
    // register box:
    // if username does not correspond to any username in users table
    // add username and hashed password to users table
    // then redirect to newslogin.html
    
    if (isset($_POST['submit_register'])) {      
        $name = $_POST["new_name"];
        $pass = $_POST["new_pass"];

        
        $hash = password_hash($pass, PASSWORD_BCRYPT);
        // echo "your hashed password is: " . $hash . "<br>";
        
        $current_users = $mysqli->prepare("select username from users order by username"); // get current users
        if(!$current_users){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        
        $current_users->execute();
        $current_users->bind_result($username); // store usernames in variable
        
        $user_exists = false;       
       
        while($current_users->fetch()){ // loop through all users
            if ($name === $username){ // check for username
                $user_exists = true;
                break;
            }
        }
       $current_users->close();
       
        if ($user_exists){
            echo "user ".$name." already exists.";
            echo "<a href=../newslogin.html>Home</a>";
            exit;
        }
        else{ // register new user
             $create_user = $mysqli->prepare("insert into users (username, password_hash) values (?, ?)");
            if(!$create_user){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            
            $create_user->bind_param('ss', $name, $hash); // input name and hash into the table
            $create_user->execute();
            $create_user->close();
            
            echo "hi " . $name . ", your account has been created!<br>";
            echo "<a href=../newslogin.html>Login</a>";
        }
    }
    
    
    // login box: enter username and password
    // if username corresponds to username in users table
    // check if hashed password corresponds
    // then allow into site
    
    if (isset($_POST['submit_login'])) {
        $name = $_POST["name"];
        $pass = $_POST["pass"];
        
        
        $current_users = $mysqli->prepare("select username from users order by username");
        if(!$current_users){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        
        $current_users->execute();
        $current_users->bind_result($username);
        
        $user_exists = false;       
       
        while($current_users->fetch()){ // loop through all users
            if ($name === $username){ // check for username
                $user_exists = true;
                break;
            }
        }
        $current_users->close();
        
        if ($user_exists){ // if username is in table
            $get_hash = $mysqli->prepare("select password_hash from users where username=?");
            // get the password_hash from the table
            if(!$get_hash){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            
            $get_hash->bind_param('s', $name);
            $get_hash->execute();
            $get_hash->bind_result($hash); // store in variable
            $get_hash->fetch();
            $get_hash->close();
            
            if (password_verify($pass, $hash)){ // if the password matches the hash
                // successful login
                echo "yay ".$name.", you're logged in!";
            } else { // if password wrong
                echo "<br>incorrect password.";
                echo "<a href=../newslogin.html>Try Again or Register for an Account</a>";
            }
        } else { // if username wrong
            echo "user ".$name." does not have an account.";
            echo "<a href=../newslogin.html>Try Again or Register for an Account</a>";
            exit;
        }
    }
    $mysqli->close();
?>