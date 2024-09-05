<?php

// start session (we will be using session in this page)
session_start();

//connect to database
$database = connectToDB();


// 3. get all the data from the login page form
$email = $_POST['email'];
$password = $_POST['password'];

// 4. check for error (make sure all fields are filled)
if ( empty( $email ) || empty( $password ) ) {
    $_SESSION['error'] = "Please fill in all the fields!";
    header("Location: /login");
    exit;
} else {
     // 5. check if the email entered is in the system or not
    // 5.1 sql command
    $sql = "SELECT *FROM users WHERE email = :email";    
    // 5.2 prepare
    $query = $database->prepare($sql);
    // 5.3 execute
    $query->execute([
        'email' => $email
    ]);
    // 5.4 fetch
    $user = $query->fetch(); // return the first row of the list

    // check if user exists
    if ( $user ) {
        // 6. check if the password is correct or not
        if ( password_verify( $password, $user["password"] ) ) {
            // 7. login the user(you want to store the data in the browser)
            $_SESSION['user'] = $user;

            // 8. redirect the user back to index.php
            header("Location: /");
                exit;
        } else {
            setError( "The password provided is incorrect, please try again.", '/login' );
        }   
    } else {
        setError( "This email is not registered inside our database.", '/login' );
    }
    
}    