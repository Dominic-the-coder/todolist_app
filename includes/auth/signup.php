<?php

//connect to database
$database = connectToDB();

// 3. get all the data from the sign-up page form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// 4. check for error (make sure all fields are filled)
if ( empty($name) || empty( $email ) || empty( $password ) || empty( $confirm_password ) ) {
   echo "All the fields are required";
}else if ( $password !== $confirm_password ) {
    echo "the password is not match";
}else if ( strlen($password) < 8 ) { // check for the password length (make sure it's at least 8 characters)
    echo "Your password must be at least 8 characters";
}else {
    // check if the email already in-used or not
    // sql command
    $sql = "SELECT * FROM users WHERE email = :email";    

    //prepare
    $query = $database -> prepare($sql);

    // execute
    $query -> execute([
        'email' => $email
    ]);

    // fetch
    $user = $query -> fetch(); //return the first row starting from the query row

    // if user exists, it means the email already in-used
    if ( $user ) {
        echo '<script>alert("The email entered already in-used! Please use another email");window.location.href="signup.php";</script>';
    } else {
        // create the user
        // SQL Command (Recipe)
        $sql = "INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)";
        // Prepare SQL query (Prepare Ingredients)
        $query = $database->prepare($sql);
        // Execute SQL query (Cook)
        $query->execute([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        // Redirect user back to index.php after the process
        echo '<script>alert("Successfully signed up!");window.location.href="/login"</script>';
        exit;

    }
}