<?php

//connect to database
$database = connectToDB();

    $label = $_POST["list_name"];

    // 1. check whether the user insert a name
        if(empty( $label ) ){
            setError( "Please insert a task", "/" ); 
       }else{
        // 2. add the student name to database
        // 2.1 (recipe)
        $sql = 'INSERT INTO todolist (`label`) VALUES(:label)';
        // 2.2 (prepare)
        $query = $database->prepare( $sql );
        // 2.3 (execute)
        $query->execute([
            'label' => $label
            "user_id" => $_SESSION['user']['id']
        ]);

    // 3. redirect the user back to index.php
        header("Location: /");
        exit;

   }
