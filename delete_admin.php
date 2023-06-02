<?php
session_start();
include "connection.php";
// Redirect user if not logged in
if (!isset($_SESSION['admin_number'])) {
    header("Location: index.php");
    exit();

}
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the admin number from the form
    $adminNumber = $_POST['adminNumber'];


    // Prepare the delete statement
    $sql = "DELETE FROM library_admin WHERE admin_number = ?";

    if ($stmt = mysqli_prepare($db, $sql)) {
        // Bind the admin number parameter
        mysqli_stmt_bind_param($stmt, "i", $adminNumber);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Check if a row was affected
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $error_message = "Staff Information Deleted Successfully.";
            $popup_message = array($error_message);
            $message_str = implode('\n', $popup_message);
            echo '<script type="text/javascript">
                window.onload = function(){
                    alert("' . $message_str . '");
                    window.location.href = "admin_staff.php";
                }
            </script>';
        } else {
            echo "No admin found with the specified admin number.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($db);
    }

    // Close the connection
    mysqli_close($db);
}
?>