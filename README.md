# php_email
It is a php based login system 

Applications required - 
1. Xammp (which is an Apache Distribution)
   Download it through (https://www.apachefriends.org/download.html).Install it according to your system requirements
2. MySQL
3. Remember you need to "compose"(install) PHP mailer inside "email_demo" folder (https://github.com/PHPMailer/PHPMailer).
   
IDE used - Visual Studio Code.

How to run the project in my system?
------------------------------------------
1. Clone the repo inside the "htdocs" folder which is located inside the main xammp folder.
2. Start the Apache and MySQL service through xammp control panel(you may find the control panel by searching through the start button)
3. Use the control panel to open admin panel of MySQL
4. Now create a new database as "signupphp"
5. Create a table with table name "users" with 6 columns :
	CREATE TABLE `users`. (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(191) NULL , `email` VARCHAR(191) NULL , `password` VARCHAR(191) NULL , `otp` VARCHAR(6) NULL , `is_verified` BOOLEAN NOT NULL DEFAULT FALSE , PRIMARY KEY (`id`)) ENGINE = InnoDB;

(Use the above command to simply create the table through MySQL admin panel)

6. Remember to check the username and password according to your credentials.
7. Also you will need to change the username (this mail id should be the one from where you need to send the mail) and password in "generateAndStoreOTP.php".
8. To generate the password you will need to enable and do a 2-step verification of your google mail ID
9. Then navigate to "App passwords" by searching in the search bar of your google account .
10.Give an app name and create the password.The password thus generated must be copied (without providing space) in the "generateAndStoreOTP.php" file
11.Navigate to browser "http://localhost/email_demo/signup.php"

Incase you face any problem while executing this project feel free to reach out to me :)
