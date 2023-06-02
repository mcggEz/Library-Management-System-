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
    $resource = $_POST['resource'];
    // Query the user table to retrieve the user's information
    $query = "SELECT control_number, age, sex, school_organization FROM user WHERE control_number = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $controlNumber);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userAge = $row['age'];
        $userSex = $row['sex'];
        $userOrganization = $row['school_organization'];


        // Insert a new row into the library_resources table
        $resource = $_POST['resource'];
        $insertQuery = "INSERT INTO library_resources (control_number, age, sex, school_organization, time_in, resource) 
                        VALUES (?, ?, ?, ?, NOW(), ?)";
        $insertStmt = mysqli_prepare($db, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "sssss", $controlNumber, $userAge, $userSex, $userOrganization, $resource);
        mysqli_stmt_execute($insertStmt);
        $message = "Control Number was recorded for library resources usage successfully.";
        $msg = true;
    } else {
        $message = "User not found. Please check the control number.";
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
                    <span class="sBtn-text">Library Resources</span>
                    <i class="bx bx-chevron-down"></i>
                </div>

                <ul class="options">
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

        <!--Library Resources FORM-->
        <div class="library_forms_main">
            <div class="user_input_form">
                <section class="attendance">
                    <h1>Please input the right information.</h1>
                    <form class="user_form_post" method="post">
                        <input class="control_number_input" type="text" name="control_number"
                            placeholder="Control Number" required>
                        <select name="resource" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="computer_section">Computer Section</option>
                            <option value="periodical_section">Periodical Section</option>
                            <option value="film_showing">Film Showing</option>
                            <option value="library_orientation">Library Orientation</option>
                            <option value="gad_corner">GAD Corner</option>
                            <option value="manilaniana_section">Manilaniana Section</option>
                            <option value="story_telling">Story Telling</option>
                            <option value="arts_and_craft_activities">Arts and Craft Activities</option>
                            <option value="reading_and_writing_activities">Reading and Writing Activities</option>
                            <option value="general_reference_section">General Reference Section</option>
                            <option value="board_games">Board Games</option>
                            <option value="e_resources_sections">E-Resources Section</option>
                        </select>
                        <style>
                            select {
                                display: block;
                                width: 100%;
                                height: 40px;
                                padding: 0.5rem 1rem;
                                font-size: 16px;
                                line-height: 1.5;
                                color: #495057;
                                background-color: #fff;
                                background-clip: padding-box;
                                border: 1px solid #ced4da;
                                border-radius: 0.25rem;
                                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                            }

                            select:focus {

                                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
                            }
                        </style>

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