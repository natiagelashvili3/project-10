<?php

    include 'helpers/db_connection.php';

    if(isset($_POST['action']) && $_POST['action'] == 'subscribe') {
        $email = $_POST['email'];

        $query = "INSERT INTO subscription (email) VALUES ('$email')";

        $result = query($query);

    }