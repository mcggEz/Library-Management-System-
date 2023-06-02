<?php
session_start();
include "connection.php";
//kicks user out if not logged in
if (!isset($_SESSION['control_number'])) {
    header("Location: index.php");
    exit();
}
include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user_dashboard.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">
    <title>User Dashboard Panel</title>
</head>

<body>

    <nav class="sidebar">
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="user_dashboard.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li>
                    <a href="user_profile.php">
                        <i class="uil uil-setting"></i>
                        <span class="link-name">Profile</span>
                    </a>
                </li>

                <li><a href="user_feedbacks.php">
                        <i class="uil uil-comment-dots"></i>
                        <span class="link-name">Feedbacks</span>
                    </a></li>
                <li>
                    <a href="user_settings.php">
                        <i class="uil uil-setting"></i>
                        <span class="link-name">Settings</span>
                    </a>
                </li>
            </ul>
            <li><a href="user_help.php">
                    <i class="uil uil-question-circle"></i>
                    <span class="link-name">Help</span>
                </a></li>

            <ul class="logout-mode">
                <li><a href="logout.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>

            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="mode-toggle"></div>
            <button class="back-button" onclick="window.location.href='user_profile.php'">
                <i class="fas fa-arrow-left"></i> Back
            </button>

        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Reset Password</span>
                </div>
            </div>
        </div>


        <?php
        $control_number = $_SESSION['control_number'];


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get user's input
            $new_password = $_POST['password'];
            $confirm_new_password = $_POST['confirm_password'];

            // Validate new password
            $lengthRequirement = 8;
            $uppercaseRequirement = 1;
            $lowercaseRequirement = 1;
            $numberRequirement = 1;
            $specialCharRequirement = 1;
            $exceptions = array("\\", "~", "<", " ", "\t");

            $isLengthValid = strlen($new_password) >= $lengthRequirement;
            $isUppercaseValid = preg_match('/[A-Z]/', $new_password) === $uppercaseRequirement;
            $isLowercaseValid = preg_match('/[a-z]/', $new_password) === $lowercaseRequirement;
            $isNumberValid = preg_match('/[0-9]/', $new_password) === $numberRequirement;
            $isSpecialCharValid = preg_match('/[!@#$%^&*()\-_=+{}[\]|;:"<>,.?\/`~\\\\]/', $new_password) === $specialCharRequirement;
            $isExceptionsValid = !preg_match('/[\s\\\\~<]/', $new_password);

            if ($new_password !== $confirm_new_password) {
                $error_message = "Passwords do not match";
                $popup_message[] = $error_message;
                $message_str = implode('\n', $popup_message);
                echo '<script type="text/javascript">
                    window.onload = function(){
                        alert("' . $message_str . '");
                    }
                </script>';
            } elseif (!$isLengthValid || !$isUppercaseValid || !$isLowercaseValid || !$isNumberValid || !$isSpecialCharValid || !$isExceptionsValid) {
                $error_message = "Your password does not meet the requirements:";
                $popup_message[] = $error_message;
                $message_str = implode('\n', $popup_message);
                echo '<script type="text/javascript">
                    window.onload = function(){
                        alert("' . $message_str . '");
                    }
                </script>';
            } else {
                // Update password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the date_password_update field to the current time
                $current_time = date('Y-m-d H:i:s');
                $query = "UPDATE user SET password = '$hashed_password', date_password_update = '$current_time' WHERE control_number = '$control_number'";
                mysqli_query($db, $query);

                $success = "Password successfully updated";
                $popup_message[] = $success;
                $message_str = implode('\n', $popup_message);
                echo '<script type="text/javascript">
                    window.onload = function(){
                        alert("' . $message_str . '");
                        window.location.href = "user_profile.php";
                    }
                </script>';
            }
        }
        ?>

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
                <p id="check0">At least 8 characters</p>
                <p id="check1">At least one uppercase letter (A-Z)</p>
                <p id="check2">At least one lowercase letter (a-z)</p>
                <p id="check3">At least one number (0-9)</p>
                <p id="check4">At least one special character (_-+!=@%*&":/ and etc.)</p>
                <p id="check5">Exceptions: \, ~, <, space, tab</p>
            </div><br>

            <div class="form-control">
                <p>Confirm your new Password</p>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your Password"
                    oninput="checkConfirmPassword();">
                <div class="show_password">
                    <input type="checkbox" id="show-confirm-password" class="checkbox-input"
                        onchange="togglePasswordVisibility('confirm_password', 'show-confirm-password');">
                    <p>Show Password</p>
                </div>
            </div>
            <p id="confirm_password_message"></p>


            <input type="submit" class="button" name="submit" value="Reset Password">
        </form>

    </section>
    <script src="password.js"></script>
    <script src="admin.js"></script>

</body>

</html>