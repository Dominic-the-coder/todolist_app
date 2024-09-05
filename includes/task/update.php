<?php
    
//connect to database
$database = connectToDB();
   
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
        
        header("Location: /");
        exit;
   }else if ($completed == 0){
        $sql = "UPDATE todolist set completed = '1' WHERE id = :id";

        $query = $database->prepare ($sql);

        $query -> execute([
            'id' => $list_id
        ]);

        header("Location: /");
        exit;
   }
        
        
        

   
   