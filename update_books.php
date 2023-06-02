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
    $bookId = $_POST['bookId'];
    $accNumber = $_POST['accNumber'];
    $dateReceived = $_POST['dateReceived'];
    $classNumber = $_POST['classNumber'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $edition = $_POST['edition'];
    $volume = $_POST['volume'];
    $pages = $_POST['pages'];
    $publisher = $_POST['publisher'];
    $yearAvailability = $_POST['yearAvailability'];
    $section = $_POST['section'];

    // Prepare and execute the SQL query to update the book
    $sql = "UPDATE library_books SET
                acc_number = '$accNumber',
                date_received = '$dateReceived',
                class_number = '$classNumber',
                author = '$author',
                title = '$title',
                edition = '$edition',
                volume = '$volume',
                pages = '$pages',
                publisher = '$publisher',
                year_availability = '$yearAvailability',
                section = '$section'
            WHERE id = $bookId";

    if (mysqli_query($db, $sql)) {
        $error_message = "Book updated successfully.";
        $popup_message = array($error_message);
        $message_str = implode('\n', $popup_message);
        echo '<script type="text/javascript">
        window.onload = function(){
            alert("' . $message_str . '");
            window.location.href = "admin_books.php";
        }
    </script>';
    } else {
        echo "Failed to update book: " . mysqli_error($db);
    }

    // Close the database connection
    mysqli_close($db);
}
?>