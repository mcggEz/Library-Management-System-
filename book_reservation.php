<?php
session_start();
include "connection.php";

// Redirect user if not logged in
if (!isset($_SESSION['control_number'])) {
    header("Location: login.php");
    exit();
}

$error_message = "";
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $control_number = $_SESSION['control_number'];
    $book_borrowing_date = $_POST['book_borrowing_date'];
    $acc_number = $_POST['acc_number'];

    // Check if the visit date is not yesterday
    $today = date("Y-m-d");
    if ($book_borrowing_date < $today) {
        $error_message = "You cannot reserve a book for a past date.";
    } else {
        // Check if the user has already borrowed the book
        $query = "SELECT * FROM borrowed_books WHERE control_number = '$control_number' AND acc_number = '$acc_number' AND date_book_returned IS NULL";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            $message = "You have already borrowed this book and it has not been returned.";
            $msg = true;
        } else {
            // Check if the user has already submitted a reservation for the current day
            $current_date = date("Y-m-d");
            $query = "SELECT * FROM book_reservations WHERE control_number = '$control_number' AND acc_number = '$acc_number' AND DATE(reservation_date) = '$current_date'";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) {
                $message = "You have already submitted a reservation request for this book today.";
                $msg = true;
            } else {
                // Add the reservation to the database
                $query = "INSERT INTO book_reservations (control_number, book_borrowing_date, acc_number) 
                        VALUES ('$control_number', '$book_borrowing_date', '$acc_number')";
                mysqli_query($db, $query);

                $message = "Book Reservation Request was sent successfully";
                $msg = true;

            }
        }
    }
    if ($msg) {
        $popup_message[] = $message;
        $message_str = implode('\n', $popup_message);
        echo '<script type="text/javascript">
            window.onload = function(){
                alert("' . $message_str . '");
                window.location.href = "sections.php";
            }
        </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="reservation.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>

<body>
    <!--------------------reservation Section---------------------------------------->
    <main>
        <div class="container">
            <div class="login form">
                <div class="libraryname">
                    <img src="images/logo.2.png" class="logo" alt="">
                    <p class="library_name">Manila-Sacramento Friendship Library</p>
                    <a href="sections.php"><i class="fas fa-arrow-left"></i></a>
                </div>

                <header>Book Reservation</header>
                <div class="separator"></div>
                <p class="reset_guide">Please fill up the form below for your reservation.</p><br>
                <form method="POST">
                    <label for="book_borrowing_date">When do you want to borrow the book?</label>
                    <!-- Input for date  -->
                    <input type="date" name="book_borrowing_date" min="<?php echo date('Y-m-d'); ?>" required>
                    <label for="acc_number">Book you are borrowing:</label><br>
                    <input type="hidden" name="acc_number" value="<?php echo $_GET['book_id']; ?>">
                    <?php
                    // Assuming you have a database connection established
                    
                    // Check if the acc_number is provided in the URL
                    if (isset($_GET['book_id'])) {
                        // Sanitize the input to prevent SQL injection
                        $book_id = mysqli_real_escape_string($db, $_GET['book_id']);

                        // Create the SQL query
                        $sql = "SELECT acc_number, class_number, author, title, edition, volume, publisher FROM library_books WHERE acc_number = '$book_id'";

                        // Execute the query
                        $result = mysqli_query($db, $sql);

                        // Check if a row is returned
                        if (mysqli_num_rows($result) > 0) {
                            // Fetch the book information
                            $row = mysqli_fetch_assoc($result);

                            // Display the book information
                            echo "Access Number: " . $row['acc_number'] . "<br>";
                            echo "Class Number: " . $row['class_number'] . "<br>";
                            echo "Author: " . $row['author'] . "<br>";
                            echo "Title: " . $row['title'] . "<br>";
                            echo "Edition: " . $row['edition'] . "<br>";
                            echo "Volume: " . $row['volume'] . "<br>";
                            echo "Publisher: " . $row['publisher'] . "<br>";
                        } else {
                            echo "Book not found.";
                        }
                    } else {
                        echo "No book_id provided.";
                    }

                    // Close the database connection
                    mysqli_close($db);
                    ?>
                    <!-- messages from the server side script -->
                    <div class="error-message">
                        <?php
                        if (isset($error_message)) {
                            echo $error_message;
                        }
                        ?>
                    </div>
                    <input type="submit" class="button" name="submit" value="Borrow Book">
                </form>

            </div>
        </div>
    </main>
</body>

</html>