<?php
session_start();
include "connection.php";

// Redirect user if not logged in
if (!isset($_SESSION['admin_number'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $datePosted = $_POST['datePosted'];
    $category = $_POST['category'];

    // Prepare and execute the SQL query to insert a new announcement
    $insertQuery = "INSERT INTO library_announcements (title, description, date_posted, category) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $insertQuery);
    mysqli_stmt_bind_param($stmt, "ssss", $title, $description, $datePosted, $category);

    if (mysqli_stmt_execute($stmt)) {
        $successMessage = "New announcement added successfully.";
        echo '<script type="text/javascript">
                alert("' . $successMessage . '");
                window.location.href = "admin_announcements.php";
              </script>';
    } else {
        $errorMessage = "Failed to add a new announcement: " . mysqli_error($db);
        echo '<script type="text/javascript">
                alert("' . $errorMessage . '");
                window.location.href = "admin_announcements.php";
              </script>';
    }

    // Close the database connection
    mysqli_close($db);
}
?>