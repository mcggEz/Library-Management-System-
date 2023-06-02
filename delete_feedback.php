<?php
session_start();
include "connection.php";

// Redirect user if not logged in
if (!isset($_SESSION['admin_number'])) {
    header("Location: index.php");
    exit();
}

// Check if the form is submitted for deleting a feedback
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedbackIdDelete'])) {
    // Retrieve the form data
    $feedbackId = $_POST['feedbackIdDelete'];

    // Prepare the delete statement
    $deleteQuery = "DELETE FROM user_feedbacks WHERE id=?";
    $stmt = mysqli_prepare($db, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $feedbackId);

    // Execute the delete statement
    if (mysqli_stmt_execute($stmt)) {
        // Successful deletion
        $_SESSION['successMessage'] = "Feedback deleted successfully.";
        header('Location: admin_feedbacks.php');
        exit();
    } else {
        // Failed to delete feedback
        $_SESSION['errorMessage'] = "Failed to delete the feedback: " . mysqli_error($db);
        header('Location: admin_feedbacks.php');
        exit();
    }

    // Close the database connection

}
?>