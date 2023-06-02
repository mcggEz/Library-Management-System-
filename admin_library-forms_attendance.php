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

    // Check if the user has already passed the form today
    $checkQuery = "SELECT time_in FROM attendance WHERE control_number = '$controlNumber' AND DATE(time_in) = CURDATE()";
    $checkResult = mysqli_query($db, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        $message = "User already passed the form today.";
        $msg = true;
    } else {
        // Query the user table to retrieve the user's information and check if user_access is 1
        $query = "SELECT control_number, age, sex, school_organization, user_access FROM user WHERE control_number = '$controlNumber' AND user_access = 1";
        $result = mysqli_query($db, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $userAge = $row['age'];
            $userSex = $row['sex'];
            $userOrganization = $row['school_organization'];

            // Insert the attendance record into the attendance table
            $insertQuery = "INSERT INTO attendance (control_number, age, sex, school_organization, time_in) 
                            VALUES ('$controlNumber', '$userAge', '$userSex','$userOrganization', NOW())";
            mysqli_query($db, $insertQuery);

            $message = "Attendance recorded successfully";
            $msg = true;
        } else {
            $message = "User not found or blocked. Please check the control number.";
            $msg = true;
        }
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
                    <span class="sBtn-text">Attendance</span>
                    <i class="bx bx-chevron-down"></i>
                </div>

                <ul class="options">
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
                    <li class="option">
                        <a href="borrow_book.php">
                            <span class="option-text">Borrow Book</span>
                        </a>
                    </li>
                    <li class="option">
                        <a href="return_book.php">
                            <span class="option-text">Return Book</span>
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

                </section>
            </div>
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