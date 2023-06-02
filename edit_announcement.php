<?php
session_start();
include "connection.php";

// Redirect user if not logged in
if (!isset($_SESSION['admin_number'])) {
    header("Location: index.php");
    exit();
}

// Check if the form is submitted for editing an announcement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $announcementId = $_POST['announcementId'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $datePosted = $_POST['datePosted'];
    $category = $_POST['category'];

    // Prepare the update statement
    $updateQuery = "UPDATE library_announcements SET title=?, description=?, date_posted=?, category=? WHERE announcement_id=?";
    $stmt = mysqli_prepare($db, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ssssi", $title, $description, $datePosted, $category, $announcementId);

    // Execute the update statement
    if (mysqli_stmt_execute($stmt)) {
        $successMessage = "Announcement updated successfully.";
        echo '<script type="text/javascript">
                alert("' . $successMessage . '");
                window.location.href = "announcement.php";
              </script>';
    } else {
        $errorMessage = "Failed to update the announcement: " . mysqli_error($db);
        echo '<script type="text/javascript">
                alert("' . $errorMessage . '");
                window.location.href = "admin_announcements.php";
              </script>';
    }

    // Close the database connection
    mysqli_close($db);
}
?>