<?php
session_start();
include "connection.php";

if (isset($_SESSION['admin_number'])) {
    $admin_number = $_SESSION['admin_number'];

    // Unset all of the session variables
    $_SESSION = array();
    // End the session
    session_unset();
    session_destroy();
}

// Redirect the user to the index.php page
header("Location: login.php");
exit();
?>