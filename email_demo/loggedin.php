<?php
include("protect.php");
if (!isset($_SESSION["user_id"])) {
    header("Location:login.php");
    exit();
}
if (isset($_POST['login'])) {

    //connect to the db
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "signupphp";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    //check if user exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // verify the password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $row['id'];  
            echo "Logged In...";
        } else {
            $_SESSION['message'] = 'Incorrect email id or password';
            header("location: /email_demo/login.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = 'user does not exists';
        header("location: /email_demo/login.php");
        exit(0);
        //$error = "Invalid email or password";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    
    <h3>You have successfully logged in!</h3>
    <p>User logged in!</p>
    <?php 
    if(isset($_SESSION['user_id'])):
    ?>
    <a href="logout.php" style="text-decoration: none;" class="btn btn-primary">Logout</a>
    <?php /* unset($_SESSION['user_id']); */
    endif; 
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>