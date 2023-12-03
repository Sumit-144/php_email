<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$email = $_GET['value'];

generateAndStoreOTP($email);

function generateAndStoreOTP($email)
{

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "signupphp";


    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $otp = mt_rand(100000, 999999);

    // Insert the OTP into the database
    $sql = "INSERT INTO users (otp) VALUES ('$otp');";

    if ($conn->query($sql) === TRUE) {
        // OTP inserted successfully
        echo "console.log('OTP inserted: $otp')";
        echo $email;
        
    } else {
        echo "console.log('Error inserting OTP: " . $conn->error . "')";
        exit();
    }

    //Create an instance; passing `true` enables exceptions
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'sachten144@gmail.com';                     //SMTP username
        $mail->Password   = 'jbvfmgdcmuauersr';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('sachten144@gmail.com', 'Sachin');
        $mail->addAddress($email, 'Joe User');     //Add a recipient


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email Verification';
        $mail->Body    = 'Your OTP is : '.$otp;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    //$conn->close();
}
