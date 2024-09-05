<?php

//connect to database
function connectToDB() {
// setup database credential
$host = "localhost";
$database_name = "todolist"; //connect to which database
$database_user = "root";
$database_password = "password";

//connect to database
$database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password
);

return $database;

}

function setError( $message, $redirect ) {
    $_SESSION['error'] = $message;
    // redirect back to selected page
    header("Location: " . $redirect);
    exit;
}