<?php
session_start();
include "connection.php";
// Redirect user if not logged in
if (!isset($_SESSION['admin_number'])) {
    header("Location: index.php");
    exit();

}

// Check if the email and userAccess parameters are present
if (isset($_POST['email']) && isset($_POST['userAccess'])) {
    $email = $_POST['email'];
    $userAccess = $_POST['userAccess'];

    // Convert the userAccess value to boolean
    $userAccess = $userAccess == 'block' ? 0 : 1;

    // Update the user's access in the database
    $query = "UPDATE user SET user_access = $userAccess WHERE email = '$email'";
    mysqli_query($db, $query);
    $error_message = "Member's access was been updated Successfully.";
    $popup_message = array($error_message);
    $message_str = implode('\n', $popup_message);
    echo '<script type="text/javascript">
        window.onload = function(){
            alert("' . $message_str . '");
            window.location.href = "admin_members.php";
        }
    </script>';
    // Close the database connection
    mysqli_close($db);

    // Redirect back to the original page
    header("Location: admin_members.php");
    exit();
} else {
    // Invalid request, redirect back to the original page
    header("Location: admin_members.php");
    exit();
}
?>