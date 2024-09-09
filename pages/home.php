<?php


require 'parts/header.php';

?>
    <?php if ( isset( $_SESSION['user'] ) ) : ?>

    <?php
      // connect to the database
      $database = connectToDB();

      // load the data
      // SQL command (recipe)
      $sql = "SELECT * FROM todolist WHERE user_id = :user_id";
      // prepare (prepare your material)
      $query = $database->prepare( $sql );
      // execute (cook)
      $query->execute([
        "user_id" => $_SESSION['user']['id']
      ]);
      // fetch all (eat)
      $todolist = $query->fetchAll();
      ?>
      
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
             <form method="POST" action= "/task/update" >
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
             <form method="POST" action= "/task/delete">
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
          <?php require 'parts/error_box.php' ?>
          <form method="POST" action= "/task/add" class="d-flex justify-content-between align-items-center">
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
      <a href="/logout">Logout</a>
    </div>
    <?php else: ?>
      <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px">
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <h4>Please Login To Continue</h4>
        <?php if ( isset( $_SESSION['user'] ) ) : ?>
      </div>
      <?php else : ?>
       <a href="/login">Login</a>
       <a href="/signup">Sign Up</a>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    
   <?php
      require 'parts/footer.php';
   ?>   