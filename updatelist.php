<?php
    // 1.collect data base info
    $host = "localhost";
    $database_name = "todolist"; // connect to which database
    $database_user = "root";
    $database_password = "password";

    // 2. connect to database 
    $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user, //username
    $database_password //password
    );

    $completed = $_POST["completed"];
    $list_id = $_POST["list_id"];

    if( (empty($completed)) && (empty($list_id)) ){
        echo "input something!";
   }else if ($completed == 1){
        $sql = "UPDATE todolist SET completed = '0' WHERE id = :id";

        $query = $database->prepare ($sql);
        
        $query -> execute([
            'id' => $list_id
        ]);
        
        header("Location: index.php");
        exit;
   }else if ($completed == 0){
        $sql = "UPDATE todolist set completed = '1' WHERE id = :id";

        $query = $database->prepare ($sql);

        $query -> execute([
            'id' => $list_id
        ]);

        header("Location: index.php");
        exit;
   }
        
        
        

   
   