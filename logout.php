<?php
session_start();
include "connection.php";

if (isset($_SESSION['control_number'])) {
    $control_number = $_SESSION['control_number'];

    // Update the user's status in the database
    $updateStmt = $db->prepare("UPDATE `user` SET `status`='offline' WHERE `control_number`=?");
    $updateStmt->bind_param("i", $control_number);
    $updateStmt->execute();

    // End the session
    session_unset();
    session_destroy();
}

// Redirect the user to the index.php page
header("Location: login.php");
exit();
?>