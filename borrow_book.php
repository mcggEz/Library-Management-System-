<?php
session_start();
include "connection.php";

// Redirect user if not logged in
if (!isset($_SESSION['admin_number'])) {
    header("Location: index.php");
    exit();
}

include "admin_navbar.php";

// Check if submit button is clicked
if (isset($_POST['submit_button'])) {
    $controlNumber = $_POST['control_number'];
    $accNumber = $_POST['acc_number'];
    $returnDate = $_POST['date'];

    // Check if the user exists and has access
    $userQuery = "SELECT control_number FROM user WHERE control_number = ? AND user_access = 1";
    $userStmt = mysqli_prepare($db, $userQuery);
    mysqli_stmt_bind_param($userStmt, "s", $controlNumber);
    mysqli_stmt_execute($userStmt);
    mysqli_stmt_store_result($userStmt);

    if (mysqli_stmt_num_rows($userStmt) > 0) {
        // Check if the book is available for borrowing
        $borrowedQuery = "SELECT id FROM borrowed_books WHERE acc_number = ? AND is_returned = 0";
        $borrowedStmt = mysqli_prepare($db, $borrowedQuery);
        mysqli_stmt_bind_param($borrowedStmt, "s", $accNumber);
        mysqli_stmt_execute($borrowedStmt);
        mysqli_stmt_store_result($borrowedStmt);

        if (mysqli_stmt_num_rows($borrowedStmt) > 0) {
            $message = "The book is currently not available for borrowing.";
            $msg = true;
        } else {
            // Check if the user has any borrowed books that have not been returned
            $borrowedQuery = "SELECT id FROM borrowed_books WHERE control_number = ? AND date_book_returned IS NULL";
            $borrowedStmt = mysqli_prepare($db, $borrowedQuery);
            mysqli_stmt_bind_param($borrowedStmt, "s", $controlNumber);
            mysqli_stmt_execute($borrowedStmt);
            mysqli_stmt_store_result($borrowedStmt);

            if (mysqli_stmt_num_rows($borrowedStmt) > 0) {
                $message = "The user currently has a book that has not been returned.";
                $msg = true;
            } else {
                // Get the current date
                $today = date("Y-m-d");

                // Check if the return date is a future date
                if ($returnDate > $today) {
                    // Insert the borrowed book record
                    $insertQuery = "INSERT INTO borrowed_books (control_number, acc_number, borrow_date, return_date) VALUES (?, ?, CURDATE(), ?)";
                    $insertStmt = mysqli_prepare($db, $insertQuery);
                    mysqli_stmt_bind_param($insertStmt, "sss", $controlNumber, $accNumber, $returnDate);
                    mysqli_stmt_execute($insertStmt);

                    $message = "Book borrowed successfully";
                    $msg = true;
                } else {
                    $message = "Invalid return date. Please select a future date.";
                    $msg = true;
                }
            }
        }
    } else {
        $message = "User not found or blocked. Please check the control number.";
        $msg = true;
    }

    if ($msg) {
        $popup_message[] = $message;
        $message_str = implode('\n', $popup_message);
        echo '<script type="text/javascript">
            window.onload = function(){
                alert("' . $message_str . '");
                window.close();
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

    <link rel="stylesheet" href="admin_dashboard.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


</head>

<body>
    <section class="library_forms">

        <div class="select-menu-container">
            <div class="select-menu">
                <div class="select-btn">
                    <span class="sBtn-text">Borrow Book</span>
                    <i class="bx bx-chevron-down"></i>
                </div>

                <ul class="options">
                    <li class="option">
                        <a href="return_book.php">
                            <span class="option-text">Return Book</span>
                        </a>
                    </li>

                    <li class="option">
                        <a href="admin_library-forms_attendance.php">
                            <span class="option-text">Attendance</span>
                        </a>
                    </li>
                    <li class="option">
                        <a href="library_space.php">
                            <span class="option-text">Library Space</span>
                        </a>
                    </li>
                    <li class="option">
                        <a href="library_resources.php">
                            <span class="option-text">Library Resources</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <script>
            const optionMenu = document.querySelector(".select-menu");
            const selectBtn = optionMenu.querySelector(".select-btn");
            const options = optionMenu.querySelectorAll(".option");
            const sBtn_text = optionMenu.querySelector(".sBtn-text");
            selectBtn.addEventListener("click", () =>
                optionMenu.classList.toggle("active")
            );

            options.forEach((option) => {
                option.addEventListener("click", () => {
                    let selectedOption = option.querySelector(".option-text").innerText;
                    sBtn_text.innerText = selectedOption;

                    optionMenu.classList.remove("active");
                });
            });

        </script>

        <!--Attendance FORM-->
        <div class="library_forms_main">
            <div class="user_input_form">
                <section class="attendance">
                    <h1>Please input the right information.</h1>
                    <form class="user_form_post" method="post">
                        <input class="control_number_input" type="text" name="control_number"
                            placeholder="Control Number" required>
                        <input class="control_number_input" type="text" name="acc_number" placeholder="Book Acc_number"
                            required>
                        <label for="date">Set the Return Date of the book:</label>

                        <input class="control_number_input" type="date" name="date" id="date"
                            min="<?php echo date('Y-m-d', strtotime('+1 days')); ?>" required>


                </section>
            </div>
        </div>

        <div class="button_submit">
            <button class="control_number_submit_button" type="submit" name="submit_button">Submit</button>
            </form>
        </div>
        <div id="datetime" class="datetime">
        </div>
    </section>
    <script>
        function showDateTime() {
            // Get current date and time
            var currentDateTime = new Date();

            // Extract date and time components
            var date = currentDateTime.toLocaleDateString();
            var time = currentDateTime.toLocaleTimeString();

            // Display date and time in the webpage
            var dateTimeElement = document.getElementById("datetime");
            dateTimeElement.innerHTML = "Current Date: " + date + "<br>Current Time: " + time;
        }

        // Update date and time every second
        setInterval(showDateTime, 1000);
    </script>
</body>

</html>