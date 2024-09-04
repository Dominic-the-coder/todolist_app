<?php

// start session
session_start();

//backend code

//1. collect data base info
$host = "localhost";
$database_name = "todolist"; //connect to which database
$database_user = "root";
$database_password = "password";

// 2. connect to database
$database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password
);

// 3. get app data from the database
// 3.1 - SQL command
$sql = "SELECT * FROM todolist";
// 3.2 - prepare SQL query
$query = $database->prepare($sql);
// 3.3 - execute SQL query
$query->execute();
// 3.4 - fetch all the results
$todolist = $query->fetchAll();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    
     

    <?php if ( isset( $_SESSION['user'] ) ) : ?>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <h4>Welcome Back! <?= $_SESSION['user']['name']; ?></h4>
        <ul class="list-group">

        <?php foreach ($todolist as $index => $task) : ?>
         <li
            class="list-group-item d-flex justify-content-between align-items-center"
          >
            <div>
             <form method="POST" action= "/updatelist.php" >
             <input type="hidden" name="list_id" value="<?= $task["id"]; ?>" />
             <input type="hidden" name="completed" value="<?= $task["completed"]; ?>" />

                <?php if($task["completed"]) :?>
                  <button class="btn btn-sm btn-success">
                   <i class="bi bi-check-square"></i>
                  </button>

                <?php else :?>
                  <button class="btn btn-sm btn-light">
                   <i class="bi bi-square"></i>
                  </button>
    
                <?php endif ;?>

              <span class="ms-2"><?= $index+1; ?>. <?= $task["label"]; ?></span>
             </form>
              
            </div>
            <div>
             <form method="POST" action= "/deletelist.php">
              <input type="hidden" name="list_id" value="<?= $task["id"]; ?>" />
               <button class="btn btn-sm btn-danger">
                <i class="bi bi-trash"></i>
              </button>
             </form>
            </div>
          </li>
        <?php endforeach; ?>
        
        </ul>
        <div class="mt-4">
          <form method="POST" action= "addlist.php" class="d-flex justify-content-between align-items-center">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name="list_name"
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      </div>
    </div>
    
    <div class="d-flex justify-content-center">
      <a href="logout.php">Logout</a>
    </div>
    <?php else: ?>
      <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px">
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <?php if ( isset( $_SESSION['user'] ) ) : ?>
      </div>
      <?php else : ?>
       <a href="login.php">Login</a>
       <a href="signup.php">Sign Up</a>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>