<?php
session_start();
include "connection.php";

// Redirect user if not logged in
if (!isset($_SESSION['admin_number'])) {
    header("Location: index.php");
    exit();
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the book ID from the form
    $bookID = $_POST['bookID'];



    // Create the deletion query
    $query = "DELETE FROM borrowed_books WHERE id = $bookID";

    // Execute the deletion query
    if (mysqli_query($db, $query)) {
        $error_message = "Deleted Successfully.";
        $popup_message = array($error_message);
        $message_str = implode('\n', $popup_message);
        echo '<script type="text/javascript">
        window.onload = function(){
            alert("' . $message_str . '");
            window.location.href = "admin_borrowed_books.php";
        }
    </script>';
    } else {
        // Handle the case where deletion fails
        echo "Error deleting book: " . mysqli_error($db);
    }

    // Close the database connection
    mysqli_close($db);
}
?>