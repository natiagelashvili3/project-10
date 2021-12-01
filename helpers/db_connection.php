<?php

$serverName = 'localhost';
$username = 'root';
$password = '';
$dbname = 'blog';

$conn = mysqli_connect($serverName, $username, $password, $dbname);

if(!$conn){
    echo "connection faild";
    exit;
}


function getAll($sql){
    global $conn;
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC); // [ [], [] ]
}


function getFirst($sql){
    global $conn;
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result); // []
}


function query($sql) {
    global $conn;
    return mysqli_query($conn, $sql);
}