<?php

    session_start();
    
    include 'helpers/functions.php';
    include 'helpers/db_connection.php';

    isGuest();

    $error = '';
    if(isset($_POST['action']) && $_POST['action'] == 'login') {
        $username = isset($_POST['username']) && $_POST['username'] != '' ? $_POST['username'] : null; 
        $password = isset($_POST['password']) && $_POST['password'] != '' ? $_POST['password'] : null; 

        if($username && $password) {
            $password = md5($password);

            $sql = 'SELECT * FROM users WHERE username = "'.$username.'" AND password = "'.$password.'"';

            $user = getFirst($sql);
            
            if($user) {
                session_start();
                $_SESSION['is_admin'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['username'];
                header('location: index.php');
            } else {
                $error = 'Invalid User';
            }
        } else {
            $error = 'Fill in all fields';
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="login-contianer">
        <div class="content">
            <form class="form-login" action="" method="POST">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="action" value="login">
                        <button class="btn">Login</button>
                        <a class="registration-btn" href="registration.php">registration</a>
                    </div>
                    <div>
                        <?php 
                            if($error) {
                                echo $error;
                            }
                        ?>
                    </div>
                </form>
        </div>
    </div>
    
</body>
</html>