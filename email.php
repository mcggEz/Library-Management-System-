<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
include "connection.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Check if the email exists in the user table
    $email_check_sql = "SELECT * FROM user WHERE email = '$email'";
    $email_check_result = mysqli_query($db, $email_check_sql);

    if (mysqli_num_rows($email_check_result) == 0) {
        // User does not exist, display error message
        $message = "Invalid email. Please enter a valid email address.";
    } else {
        $row = mysqli_fetch_assoc($email_check_result);
        $request_count = $row['request_count'];
        $first_request_time = $row['first_request_time'];
        $expiration_time = $row['expiration_time'];

        // Check if the user has already exceeded the maximum request count or has an active request
        if ($request_count >= 3 && strtotime($first_request_time) > strtotime('-1 day')) {
            $message = "You have reached the limit for forgot password requests. Please wait before sending any more requests.";
        } elseif ($expiration_time > date('Y-m-d H:i:s')) {
            // User has an active request, do not process the request
            $message = "Please wait until your previous request expires before sending a new one.";
        } else {
            // Check if the request count is >= 3 and the time is not within 24 hours from the first request
            if ($request_count >= 3 && strtotime($first_request_time) < strtotime('-1 day')) {
                // Reset request count and update first request time
                $request_count = 1;
                $first_request_time = date('Y-m-d H:i:s');
            }

            // Proceed with the request

            // Check if it's the first request of the day or within 24 hours of the first request
            $current_time = time();
            $elapsed_time = $current_time - strtotime($first_request_time);

            if ($request_count == 0) {
                // First request, set request count to 1 and update first request time
                $request_count = 1;
                $first_request_time = date('Y-m-d H:i:s', $current_time);
            } elseif ($request_count == 1 && $elapsed_time <= 24 * 60 * 60) {
                // Second request within 24 hours, increment request count
                $request_count++;
            } elseif ($request_count == 2 && $elapsed_time <= 24 * 60 * 60) {
                // Third request within 24 hours, increment request count
                $request_count++;
            } elseif ($request_count == 1) {
                // Second request after 24 hours, update first request time
                $first_request_time = date('Y-m-d H:i:s', $current_time);
            } elseif ($request_count == 2) {
                // Third request after 24 hours, reset request count and update first request time
                $request_count = 1;
                $first_request_time = date('Y-m-d H:i:s', $current_time);
            }

            // Generate a unique token and store it in the database
            $token = bin2hex(random_bytes(32)); // generates a 64-character hexadecimal string

            // Set expiration time to 5 minutes from now
            $expiration_time = date('Y-m-d H:i:s', $current_time + (5 * 60)); // 5 minutes in seconds

            // Update the database with the new values
            $sql_update = "UPDATE user SET reset_token = '$token', expiration_time = '$expiration_time', 
                            request_count = '$request_count', first_request_time = '$first_request_time'
                            WHERE email = '$email'";
            mysqli_query($db, $sql_update);

            // Send an email to the user with a link to reset password
            // Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                // Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
                $mail->isSMTP(); // Send using SMTP
                $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'sample@email.com'; // I have not provided any email here. Make sure to provide email
                $mail->Password = 'strong_Password1'; // Please include the right password.
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
                $mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                // Recipients
                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress($email); // Set the recipient address to the email provided by the user
                $mail->addReplyTo('info@example.com', 'Information');

                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'Reset Your Password';
                $mail->Body = 'Dear User,<br><br>We have received a request to reset your password. 
                If you did not make this request, please ignore this email.<br><br>To reset your 
                password, please click on the following link:<br><br><a href="http://192.168.0.39/lms/reset-password.php?token=' . $token . '">
                Reset Password</a><br><br>If the above link does not work, please copy and paste the following URL into your
                web browser:<br><br>http://192.168.0.39/lms/reset-password.php?token=' . $token . '<br><br>Thank you,<br>Your Website Team';

                $mail->send();
                $message = "Message has already been sent to the email.";



            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
}

?>