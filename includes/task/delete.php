<?php

//connect to database
$database = connectToDB();

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
    header("Location: /");
    exit;