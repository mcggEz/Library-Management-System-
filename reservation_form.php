<?php
session_start();
include "connection.php";

// Redirect user if not logged in
if (!isset($_SESSION['control_number'])) {
    header("Location: index.php");
    exit();
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
                <form method="POST" action>
                    <label for="visit_date">When would you like to visit?</label>
                    <input type="date" name="visit_date" required>
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