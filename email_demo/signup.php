<?php
session_start();
//$_SESSION['otp_verify_flag'] = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script>
        function getEmail() {
            var email = document.getElementById("email").value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                }
            };
            xhr.open("GET", "generateAndStoreOTP.php?value=" + encodeURIComponent(email), true);
            xhr.send();
            document.getElementById("otpField").style.display = "block";
        }
    </script>
</head>

<body>
    
    <div class="container" style="display: flex; flex-direction: column; margin: 100px; height: 150px;">
        <h2 style="display: flex; align-items: center; justify-content: center;">Sign Up</h2>

        <div class="d-flex justify-content-center align-items-center vh-100">
            <form action="login.php" method="post" class="col-md-4 border p-5">

                <div class="mb-2">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" required><br>
                </div>

                <div class="mb-2">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <button type="button" onclick="getEmail()" class="btn btn-primary">Verify Email</button><br>
                </div>

                <div id="otpField" style="display: none;" class="mb-2">
                    <label for="otp" class="form-label">OTP:</label>
                    <input type="text" name="otp" id="otp" class="form-control mb-3" required>
                    <div class="mb-2">
                        <button type="button" onclick="verifyOTP()" class="btn btn-primary">Verify OTP</button><br>
                    </div>
                </div>
                <div class="mb-1">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" required><br>
                </div>

                <input type="submit" value="Sign Up" name="signup" class="btn btn-primary">
            </form>
        </div>

    </div>


    <script>
        function verifyOTP() {


            // get the otp
            var enteredOTP = document.getElementById("otp").value;

            //making ajax call
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (this.responseText.trim() === "success") {
                        document.getElementById("otpField").style.display = "none";
                        alert("Email verified! You can register now!");
                    } else {

                        alert("Invalid OTP. Please try again.");
                    }
                }
            };
            xmlhttp.open("GET", "verify_otp.php?otp=" + enteredOTP, true);
            xmlhttp.send();


        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>



</body>

</html>