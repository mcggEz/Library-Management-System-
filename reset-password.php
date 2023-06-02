<?php
include "connection.php";

if (!isset($_GET['token'])) {
    header("Location: error.php");
    exit;
}

$token = $_GET['token'];
$sql = "SELECT * FROM user WHERE reset_token = '$token'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $expiration = strtotime($row['expiration_time']);
    $current_time = strtotime('now');

    if ($current_time <= $expiration) { // check if token is still valid
        if (isset($_POST['submit'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            $token_check_sql = "SELECT * FROM user WHERE reset_token = '$token'";
            $token_check_result = mysqli_query($db, $token_check_sql);

            if (mysqli_num_rows($token_check_result) == 1) {
                if ($password == $confirm_password) {
                    // Perform password validation
                    $lengthRequirement = 8;
                    $uppercaseRequirement = 1;
                    $lowercaseRequirement = 1;
                    $numberRequirement = 1;
                    $specialCharRequirement = 1;
                    $exceptions = array("\\", "~", "<", " ", "\t");

                    $isLengthValid = strlen($password) >= $lengthRequirement;
                    $isUppercaseValid = preg_match('/[A-Z]/', $password) === $uppercaseRequirement;
                    $isLowercaseValid = preg_match('/[a-z]/', $password) === $lowercaseRequirement;
                    $isNumberValid = preg_match('/[0-9]/', $password) === $numberRequirement;
                    $isSpecialCharValid = preg_match('/[!@#$%^&*()\-_=+{}[\]|;:"<>,.?\/`~\\\\]/', $password) === $specialCharRequirement;
                    $isExceptionsValid = !preg_match('/[\s\\\\~<]/', $password);

                    if (
                        $isLengthValid && $isUppercaseValid && $isLowercaseValid && $isNumberValid &&
                        $isSpecialCharValid && $isExceptionsValid
                    ) {
                        // Hash the password
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        // Prepare the SQL statement
                        $sql = "UPDATE `user` SET `password`=?, `reset_token`=NULL, `expiration_time`=NULL WHERE `reset_token`=?";
                        $stmt = mysqli_prepare($db, $sql);

                        if ($stmt) {
                            // Bind parameters to the prepared statement
                            mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $token);

                            // Execute the prepared statement
                            mysqli_stmt_execute($stmt);

                            // Close the prepared statement
                            mysqli_stmt_close($stmt);
                            $message = "Password reset successful";
                            $popup_message[] = $message;
                            $message_str = implode('\n', $popup_message);
                            echo '<script type="text/javascript">
                                window.onload = function(){
                                    alert("' . $message_str . '");
                                    window.location.href = "login.php";
                                }
                            </script>';


                        } else {
                            echo "Error: " . mysqli_error($db);
                        }
                    } else {
                        $error_message = "Invalid Password Format";
                        $popup_message[] = $error_message;
                        $message_str = implode('\n', $popup_message);
                        echo '<script type="text/javascript">
                            window.onload = function(){
                                alert("' . $message_str . '");
                            }
                        </script>';
                    }
                } else {
                    $error_message = "Passwords do not match";
                    $popup_message[] = $error_message;
                    $message_str = implode('\n', $popup_message);
                    echo '<script type="text/javascript">
                        window.onload = function(){
                            alert("' . $message_str . '");
                        }
                    </script>';
                }
            } else {

                header("Location: error.php");
                exit;
            }
        }
    } else {

        header("Location: error.php");
        exit;
    }
} else {
    header("Location: error.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="reset-password.css" />
</head>

<body>
    <div class="container">
        <div class="login form">
            <div class="libraryname">
                <img src="images/logo.2.png" class="logo" alt="">
                <p>Manila-Sacramento Friendship Library</p>
            </div>
            <header>Reset Password</header>
            <div class="separator"></div>
            <p class="reset_guide">Please fill up the form below to reset your password.</p><br>


            <form method="POST">

                <div class="form-control">
                    <p>New Password</p>
                    <input type="password" name="password" id="password" placeholder="Enter your new password"
                        oninput="checkPassword();">
                    <div class="show_password">
                        <input type="checkbox" id="show-password" class="checkbox-input"
                            onchange="togglePasswordVisibility('password', 'show-password');">
                        <p>Show Password</p>
                    </div>

                </div>
                <div id="password_requirements">
                    <!-- <p id="count">Length : 0</p> -->
                    <p id="check0">At least 8 characters</p>
                    <p id="check1">At least one uppercase letter (A-Z)</p>
                    <p id="check2">At least one lowercase letter (a-z)</p>
                    <p id="check3">At least one number (0-9)</p>
                    <p id="check4">At least one special character (_-+!=@%*&":/ and etc.)</p>
                    <p id="check5">Exceptions: \, ~, <, space, tab</p>
                </div><br>

                <div class="form-control">
                    <input type="password" name="confirm_password" id="confirm_password"
                        placeholder="Confirm your Password" oninput="checkConfirmPassword();">
                    <div class="show_password">
                        <input type="checkbox" id="show-confirm-password" class="checkbox-input"
                            onchange="togglePasswordVisibility('confirm_password', 'show-confirm-password');">
                        <p>Show Password</p>
                    </div>
                </div>
                <p id="confirm_password_message"></p>

                <input type="submit" class="button" name="submit" value="Reset Password">
            </form>





        </div>
    </div>

    <script src="password.js"></script>
</body>

</html>