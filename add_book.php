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
    $acc_number = $_POST['acc_number'];
    $date_received = $_POST['date_received'];
    $class_number = $_POST['class_number'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $edition = $_POST['edition'];
    $volume = $_POST['volume'];
    $pages = $_POST['pages'];
    $publisher = $_POST['publisher'];
    $year_availability = $_POST['year_availability'];
    $section = $_POST['section'];

    // Check if the acc_number already exists in the database
    $checkQuery = "SELECT COUNT(*) as count FROM library_books WHERE acc_number = '$acc_number'";
    $checkResult = mysqli_query($db, $checkQuery);
    $row = mysqli_fetch_assoc($checkResult);
    $count = $row['count'];

    if ($count > 0) {
        $error_message = "The Acc Number already exists in the database. Please provide a unique Acc Number.";
        $popup_message = array($error_message);
        $message_str = implode('\n', $popup_message);
        echo '<script type="text/javascript">
        window.onload = function(){
            alert("' . $message_str . '");
            window.location.href = "admin_books.php";
        }
    </script>';
        exit(); // Stop further execution if the Acc Number already exists
    }

    // Prepare and execute the SQL query to insert a new row
    $sql = "INSERT INTO library_books (acc_number, date_received, class_number, author, title, edition, volume, pages, publisher, year_availability, section)
            VALUES ('$acc_number', '$date_received', '$class_number', '$author', '$title', '$edition', '$volume', '$pages', '$publisher', '$year_availability', '$section')";

    if (mysqli_query($db, $sql)) {
        $error_message = "New book added Successfully.";
        $popup_message = array($error_message);
        $message_str = implode('\n', $popup_message);
        echo '<script type="text/javascript">
        window.onload = function(){
            alert("' . $message_str . '");
            window.location.href = "admin_books.php";
        }
    </script>';
    } else {
        echo "Failed to add a new book: " . mysqli_error($db);
    }

    // Close the database connection
    mysqli_close($db);
}
?>