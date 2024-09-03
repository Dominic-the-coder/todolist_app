<?php

// 1. collect database info
$host = 'localhost';
$database_name = "todolist"; // connecting to which database 
$database_user = "root";
$database_password = "password";

// 2. connect to database (PDO - PHP database object)
$database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user, // username
    $database_password // password
);

$list_id = $_POST["list_id"];

 // delete the selected student from the table using student ID
    // sql command (recipe)
    $sql = "DELETE FROM todolist where id = :id";
    // prepare 
    $query = $database->prepare( $sql );
    // execute
    $query->execute([
        'id' => $list_id
    ]);

    // redirect back to index.php
    header("Location: index.php");
    exit;