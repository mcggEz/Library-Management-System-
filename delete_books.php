<?php
session_start();
include "connection.php";

// Redirect user if not logged in
if (!isset($_SESSION['admin_number'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve book ID from the form
    $bookId = $_POST['bookId'];

    // Prepare and execute the SQL query to delete the book
    $sql = "DELETE FROM library_books WHERE id = $bookId";

    if (mysqli_query($db, $sql)) {
        $error_message = "Book deleted successfully.";
        $popup_message = array($error_message);
        $message_str = implode('\n', $popup_message);
        echo '<script type="text/javascript">
        window.onload = function(){
            alert("' . $message_str . '");
            window.location.href = "admin_books.php";
        }
    </script>';
    } else {
        echo "Failed to delete book: " . mysqli_error($db);
    }

    // Close the database connection
    mysqli_close($db);
}
?>