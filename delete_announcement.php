<?php
session_start();
include "connection.php";

// Redirect user if not logged in
if (!isset($_SESSION['admin_number'])) {
    header("Location: index.php");
    exit();
}

// Check if the form is submitted for deleting an announcement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $announcementId = $_POST['announcementIdDelete'];

    // Prepare the delete statement
    $deleteQuery = "DELETE FROM library_announcements WHERE announcement_id=?";
    $stmt = mysqli_prepare($db, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $announcementId);

    // Execute the delete statement
    mysqli_stmt_execute($stmt);
    $successMessage = "Announcement deleted successfully.";
    echo '<script type="text/javascript">
            alert("' . $successMessage . '");
            window.location.href = "admin_announcements.php";
          </script>';
    exit();
}
?>