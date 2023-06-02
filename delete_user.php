<?php
session_start();
include "connection.php";
// Redirect user if not logged in
if (!isset($_SESSION['admin_number'])) {
    header("Location: index.php");
    exit();

}

// Check if the email parameter is present
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Perform the delete admin action using the email value
    // Assuming you have a table named 'user' and 'email' column to identify the admin
    $query = "DELETE FROM user WHERE email = '$email'";
    mysqli_query($db, $query);
    $error_message = "Member account and information deleted Successfully.";
    $popup_message = array($error_message);
    $message_str = implode('\n', $popup_message);
    echo '<script type="text/javascript">
        window.onload = function(){
            alert("' . $message_str . '");
            window.location.href = "admin_members.php";
        }
    </script>';

} else {
    // Invalid request, redirect back to the original page
    header("Location: admin_members.php");
    exit();
}
?>