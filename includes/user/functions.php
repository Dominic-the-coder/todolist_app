<?php

// connect to database
function connectToDB() {
    // setup database credential
    $host = 'mysql';
    $database_name = 'php_docker';
    $database_user = 'root';
    $database_password = 'secret';

    // connect to the database
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user,
        $database_password
    );
    
    return $database;
}

// set error message
function setError( $message, $redirect ) {
    $_SESSION['error'] = $message;
    // redirect back to selected page
    header("Location: " . $redirect);
    exit;
}

// check if current user is an admin or not
function checkIfIsNotAdmin() {
    if ( isset( $_SESSION['user'] ) && $_SESSION['user']['role'] != 'admin' ) {
        header("Location: /");
        exit;
    }
}

function checkIfuserIsNotLoggedIn() {
    if ( !isset( $_SESSION['user'] ) ) {
      header("Location: /login");
      exit;
    }
  }