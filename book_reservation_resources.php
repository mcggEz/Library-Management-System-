<?php
session_start();
include "connection.php";

if (isset($_SESSION['control_number'])) {
    $control_number = $_SESSION['control_number'];

    // Retrieve the user's information from the database
    $selectStmt = $db->prepare("SELECT * FROM `user` WHERE `control_number`=?");
    $selectStmt->bind_param("i", $control_number);
    $selectStmt->execute();
    $user = $selectStmt->get_result()->fetch_assoc();
}

if (isset($_SESSION["control_number"])) {
    // echo '<a href="book_reservation.php">Reserve for a book now!</a>';
    header("Location: book_reservation.php");
} else {
    header("Location: login.php");
}
?>