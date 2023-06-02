<?php
session_start();
include "connection.php";
// Redirect user if not logged in
if (!isset($_SESSION['admin_number'])) {
    header("Location: index.php");
    exit();

}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $adminNumber = $_POST["adminNumber"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $sex = $_POST["sex"];
    $birthdate = $_POST["birthdate"];
    $contactNumber = $_POST["contactNumber"];




    if ($db) {
        // Prepare the update statement
        $stmt = mysqli_prepare($db, "UPDATE library_admin SET name=?, age=?, address=?, sex=?, birthdate=?, contact_number=? WHERE admin_number=?");

        // Bind parameters to the statement
        mysqli_stmt_bind_param($stmt, "sissssi", $name, $age, $address, $sex, $birthdate, $contactNumber, $adminNumber);

        // Execute the statement
        $success = mysqli_stmt_execute($stmt);

        // Check if the update is successful
        if ($success) {
            $error_message = "Staff Information Updated Successfully.";

            $popup_message = array($error_message);
            $message_str = implode('\n', $popup_message);
            echo '<script type="text/javascript">
                window.onload = function(){
                    alert("' . $message_str . '");
                    window.location.href = "admin_staff.php";
                }
            </script>';
        } else {
            $error_message = "Staff Information is not properly updated.";

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
        // Database connection error
        header("Location: error.php");
        exit;
    }
}
?>