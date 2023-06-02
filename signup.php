<?php
include "connection.php";

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $birthdate = $_POST['birthdate'];
    $school_organization = $_POST['school_organization'];

    // address
    $city = $_POST["city"];
    $district = $_POST["district"];
    $barangay = $_POST["barangay"];
    $street = $_POST["street"];

    $address = $street . ", " . $district . ", " . $barangay . ", " . $city;

    // address
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    date_default_timezone_set('Asia/Manila');
    $date_registration = date("Y-m-d");
    $date_profile_update = date("Y-m-d h:i:s A");
    $date_password_update = date("Y-m-d h:i:s A");


    $control_number_query = "SELECT MAX(`control_number`) FROM `user`";
    $result = mysqli_query($db, $control_number_query);
    $row = mysqli_fetch_array($result);
    $control_number = intval($row[0]) + 1;
    $control_number = str_pad($control_number, 4, "0", STR_PAD_LEFT);


    // Check if email is already in use
    $email_query = "SELECT COUNT(*) FROM `user` WHERE `email` = ?";
    $stmt = mysqli_prepare($db, $email_query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $email_count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($email_count > 0) {
        // Display an error message for duplicate email
        $error_message = "Email already in use!";
    } else {
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
                $sql = "INSERT INTO `user`(`control_number`,`name`, `sex`, `age`, `birthdate`, `school_organization`, `address`, `contact_number`, `email`, `password`, `date_registration`,`date_profile_update`,`date_password_update`) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
                $stmt = mysqli_prepare($db, $sql);

                if ($stmt) {
                    // Bind parameters to the prepared statement
                    mysqli_stmt_bind_param($stmt, "sssisssssssss", $control_number, $name, $sex, $age, $birthdate, $school_organization, $address, $contact_number, $email, $hashed_password, $date_registration, $date_profile_update, $date_password_update);

                    // Execute the prepared statement
                    mysqli_stmt_execute($stmt);

                    // Close the prepared statement
                    mysqli_stmt_close($stmt);

                    // Redirect to login page
                    header("Location: login.php");
                    exit;

                } else {
                    // Display an error message
                    echo "Error: Failed to prepare SQL statement.";

                }
            } else {
                // Display an error message for invalid password
                $error_message = "Password does not meet the requirements.";
            }
        } else {
            // Display an error message for password mismatch
            $error_message = "Password mismatch";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="signup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">
    <title>Sign Up Form</title>

</head>

<body>
    <section class="main">
        <div class="side">
        </div>

        <div class="signin-container">
            <div class="logo">
                <img src="images/logo.2.png" alt="logo">
                <a href="login.php">Go Back</a>
            </div>
            <div class="form">

                <p class="title"> Sign Up </p>
                <div class="separator"></div>
                <p class="welcome-message">Please provide the right information.</p>

                <!-- form itself -->
                <form class="signup_form" method="post" action="signup.php" id="signup-form">

                    <div class="form-control">
                        <input type="text" name="name" placeholder="Name" required="">

                    </div>
                    <div class="form-group">

                        <input type="number" class="form-control" id="age" name="age" min="13" max="120"
                            placeholder="Enter Age" required>


                    </div>
                    <h3 class="description" style="margin-top:20px">Sex assigned at birth:</h3><br>
                    <div class="radio-container">
                        <div class="radio-wrapper">
                            <label class="radio-button">
                                <input type="radio" name="sex" value="Male" required>
                                <span class="radio-checkmark"></span>
                                <span class="radio-label">Male</span>
                            </label>
                        </div>
                        <div class="radio-wrapper">
                            <label class="radio-button">
                                <input type="radio" name="sex" value="Female" required>
                                <span class="radio-checkmark"></span>
                                <span class="radio-label">Female</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Birthdate:</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate"
                            max="<?php echo date('Y-m-d', strtotime('-13 years')); ?>" placeholder="Enter Birthdate"
                            required>

                    </div>
                    <div class="form-control">
                        <input type="text" name="school_organization" placeholder="Organization/School">

                    </div>

                    <!-- address -->

                    <div class="form-group">

                        <select class="form-control" id="city" name="city">
                            <option value="">Select City/Municipality</option>
                            <!-- City options will be dynamically populated -->
                        </select>
                    </div>

                    <div class="form-group">

                        <select class="form-control" id="district" name="district">
                            <option value="">Select District</option>
                            <!-- District options will be dynamically populated -->
                        </select>
                    </div>

                    <div class="form-group">

                        <input type="text" class="form-control" id="barangay" name="barangay"
                            placeholder="Enter Barangay">
                    </div>


                    <div class="form-group">
                        <label for="street">Lot/Block/House/Bldg. No., Subdivision/Village, Street:</label>
                        <input type="text" class="form-control" id="street" name="street"
                            placeholder="Enter your information.">
                    </div>
                    <!-- /address -->

                    <div class="form-control">
                        <input type="tel" id="contact_number" name="contact_number" placeholder="Enter Contact Number"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 11)"
                            inputmode="numeric">

                    </div>


                    <div class="form-control">
                        <input type="email" name="email" placeholder="Email">

                    </div>


                    <!-- Password Validation -->
                    <div class="form-control">
                        <input type="password" name="password" id="password" placeholder="Password"
                            oninput="checkPassword();">
                    </div>
                    <div class="show_password">
                        <input type="checkbox" id="show-password" class="checkbox-input"
                            onchange="togglePasswordVisibility('password', 'show-password');">
                        <p>Show Password</p>
                    </div>
                    <div id="password_requirements">
                        <!-- <p id="count">Length: 0</p> -->
                        <p id="check0">At least 8 characters</p>
                        <p id="check1">At least one uppercase letter (A-Z)</p>
                        <p id="check2">At least one lowercase letter (a-z)</p>
                        <p id="check3">At least one number (0-9)</p>
                        <p id="check4">At least one special character (_-+!=@%*&":/ and etc.)</p>
                        <p id="check5">Exceptions: \, ~, &lt;, space, tab</p>
                    </div>

                    <div class="form-control">
                        <input type="password" name="confirm_password" id="confirm_password"
                            placeholder="Confirm Password" oninput="checkConfirmPassword();">
                        <div class="show_password">
                            <input type="checkbox" id="show-confirm-password" class="checkbox-input"
                                onchange="togglePasswordVisibility('confirm_password', 'show-confirm-password');">
                            <p>Show Password</p>
                        </div>
                    </div>

                    <p id="confirm_password_message"></p>

                    <?php
                    if (isset($error_message)) {
                        echo $error_message;
                    }
                    ?>
                    <!-- User Agreeement -->
                    <div class="user-agreement">

                        <h3>User Agreement</h3>
                        <div class="user_agreement_content">
                            <p>Please read and agree to the following terms and conditions:</p>
                            <ol>
                                <li>By signing up for this service, you agree to abide by the rules and regulations set
                                    forth by the library.</li>
                                <li>Your account is for personal use only and should not be shared with others.</li>
                                <li>You are responsible for maintaining the confidentiality of your login credentials.
                                </li>
                                <li>We reserve the right to suspend or terminate your account if you violate any of the
                                    terms outlined in this agreement.</li>
                                <li>I confirm that I am at least 13 years old.</li>
                            </ol>
                        </div>
                        <div class="show_password">
                            <input type="checkbox" id="show-confirm-password" class="checkbox-input"
                                onchange="togglePasswordVisibility('confirm_password', 'show-confirm-password');"
                                required="">
                            <p>I have read and agree to the terms and conditions.</p>
                        </div>

                    </div>



                    <?php
                    if (isset($error_message)) {
                        echo $error_message;
                    }
                    ?>
                    <!-- Password Validation and signup -->
                    <div class="submit_button">
                        <button class="submit" type="submit" name="signup" id="signup-form">Sign Up</button>
                    </div>
                </form>
                <script src="password.js"></script>
                <script src="address_behavior.js"></script>
            </div>
        </div>
    </section>
</body>

</html>