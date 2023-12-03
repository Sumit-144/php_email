<?php
session_start();
// Check if the provided OTP is valid
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    //connect to the db
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "signupphp";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //getting the entered otp
    $enteredOTP = $_GET["otp"];

    $sql = "SELECT * FROM users WHERE otp = '$enteredOTP'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Update user as verified and clear OTP
        $row = $result->fetch_assoc();
        $user_id = $row["id"];
        $sql = "UPDATE users SET is_verified = true, otp = NULL WHERE id = $user_id";
        $conn->query($sql);

       
        
        $_SESSION['user_id'] = $user_id;

        echo "success";

       // echo "OTP Verified Successfully!";
    }else{
        echo "failure";
    }
}
