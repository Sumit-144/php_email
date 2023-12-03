<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "signupphp";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $user_id = $_SESSION['user_id'];

    // update the concerned fields from null to given values
    $sql = "UPDATE users SET is_verified = true, otp = NULL,name = '$name',email = '$email',password = '$pwd' WHERE id = '$user_id'";
    $conn->query($sql);

    echo '<h5 style="justify-content : center;display : flex;">Registration Successful! You can login now!</h5>';

    

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hey!</strong> </strong> <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php unset($_SESSION['message']);
    endif; ?>
    <div class="container" style="display: flex; flex-direction: column; margin: 100px; height: 150px;">
        <h2 style="display: flex; align-items: center; justify-content: center;">Login</h2>
        <div class="d-flex justify-content-center align-items-center vh-100">
            <form method="post" action="loggedin.php" class="col-md-4 border p-3">
                <div class="mb-2">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required><br>
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" required><br>
                </div>

                <div class="mb-2">
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>