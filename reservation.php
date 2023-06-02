<?php
session_start();
include "connection.php";

// Redirect user if not logged in
if (!isset($_SESSION['control_number'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $control_number = $_SESSION['control_number'];
    $visit_date = $_POST['visit_date'];
    $reason_for_visit = $_POST['reason_for_visit'];

    // Check if the user has already submitted a form for today
    $current_date = date("Y-m-d");
    $query = "SELECT * FROM reservations WHERE control_number = '$control_number' AND DATE(submission_date) = '$current_date'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {

        $error_message = "You have already submitted a form for today. Please try again tomorrow.";

        echo '<script type="text/javascript">
            window.onload = function() {
                alert("' . $error_message . '");
                window.location.href = "services.php";
            };
        </script>';
    } else {
        // Add the reservation to the database
        $query = "INSERT INTO reservations (control_number, visit_date, reason_for_visit, submission_date) 
                  VALUES ('$control_number', '$visit_date', '$reason_for_visit', CURRENT_TIMESTAMP)";
        mysqli_query($db, $query);
        // Redirect the user to the section page
        $error_message = "You have already submitted a form for today. Please try again tomorrow.";
        echo '<script type="text/javascript">
        window.onload = function() {
            alert("' . $success_message . '");
            window.location.href = "services.php";
        };
    </script>';
        header("Location: reservation_form.php");
        exit();
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
                    <a href="services.php"><i class="fas fa-arrow-left"></i></a>
                </div>

                <header>Library Space Reservation Form</header>
                <div class="separator"></div>
                <p class="reset_guide">Please fill up the form below for your reservation.</p><br>
                <form method="POST">
                    <label for="visit_date">When would you like to visit?</label>
                    <!-- Input for date  -->
                    <input type="date" name="visit_date" min="<?php echo date('Y-m-d'); ?>" required>


                    <label for="reason_for_visit">Reason for visit:</label>
                    <select name="reason_for_visit" required>
                        <option value="">Please select</option>
                        <option value="Study">Study</option>
                        <option value="Research">Research</option>
                        <option value="Meeting">Meeting</option>
                        <option value="Other">Other</option>
                    </select><br>
                    <!-- messages from the server side script -->
                    <div class="error-message">
                        <?php
                        if (isset($error_message)) {
                            echo $error_message;
                        }
                        ?>
                    </div>
                    <input type="submit" class="button" name="submit" value="Reserve Seat">
                </form>
            </div>
        </div>
    </main>
</body>

</html>