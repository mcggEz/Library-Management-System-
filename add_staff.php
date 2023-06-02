<?php
session_start();
include "connection.php";
// Redirect user if not logged in
if (!isset($_SESSION['admin_number'])) {
    header("Location: index.php");
    exit();

}


// Check if the form is submitted
if (isset($_POST['signup'])) {
    // Get the form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $birthdate = $_POST['birthdate'];

    $city = $_POST['city'];
    $district = $_POST['district'];
    $barangay = $_POST['barangay'];
    $street = $_POST['street'];

    $address = $street . ", " . $district . ", " . $barangay . ", " . $city;

    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

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
        $isSpecialCharValid && $isExceptionsValid && $password == $confirm_password
    ) {
        // Check if the email already exists in the database
        $stmt = $db->prepare("SELECT COUNT(*) FROM library_admin WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($emailCount);
        $stmt->fetch();
        $stmt->close();

        if ($emailCount == 0) {
            // Email is unique, proceed with inserting the data

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the SQL statement
            $stmt = $db->prepare("INSERT INTO library_admin (name, age, sex, birthdate, address, contact_number, email, password, date_registration)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Bind the parameters to the statement
            $stmt->bind_param("sisssssss", $name, $age, $sex, $birthdate, $address, $contact_number, $email, $hashed_password, $registration_date);

            // Set the values of the variables
            $registration_date = date('Y-m-d');

            // Execute the statement
            $stmt->execute();

            // Close the statement and database connection
            $stmt->close();
            $db->close();
            // success message
            $success_message = "Successfully added a new staff .";
            $popup_message = array($success_message);
            $message_str = implode('\n', $popup_message);
            echo '<script type="text/javascript">
                window.onload = function(){
                    alert("' . $message_str . '");
                    window.location.href = "admin_staff.php";
                }
            </script>';
        } else {
            $error_message = "Email is already taken.";

            $popup_message = array($error_message);
            $message_str = implode('\n', $popup_message);
            echo '<script type="text/javascript">
                window.onload = function(){
                    alert("' . $message_str . '");
                    window.location.href = "admin_staff.php";
                }
            </script>';
        }

    } else {
        $error_message = "Password does not meet the requirements.";
        $popup_message = array($error_message);
        $message_str = implode('\n', $popup_message);
        echo '<script type="text/javascript">
            window.onload = function(){
                alert("' . $message_str . '");
                window.location.href = "admin_staff.php";
            }
        </script>';
    }
}
?>