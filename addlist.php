<?php

    // 1.collect data base info
    $host = "localhost";
    $database_name = "todolist"; // connect to which database
    $database_user = "root";
    $database_password = "password";

    // 2. connect to database 
    $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password 
    );

    $label = $_POST["list_name"];

    // 1. check whether the user insert a name
        if(empty( $label ) ){
            echo "Please insert a name"; 
       }else{
        // 2. add the student name to database
        // 2.1 (recipe)
        $sql = 'INSERT INTO todolist (`label`) VALUES(:label)';
        // 2.2 (prepare)
        $query = $database->prepare( $sql );
        // 2.3 (execute)
        $query->execute([
            'label' => $label
        ]);

    // 3. redirect the user back to index.php
        header("Location: index.php");
        exit;

   }
