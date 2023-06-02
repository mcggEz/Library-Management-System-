<?php
// Database connection details
include "connection.php";

// Fetch data from the user table
$sql = "SELECT * FROM user";
$result = mysqli_query($db, $sql);

// Create the Excel file
$filename = 'user_data.xlsx';

// Set headers for Excel file download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Create a file pointer
$file = fopen('php://output', 'w');

// Write headers to the Excel file
$headers = array('Control Number', 'Date Registration', 'Name', 'Age', 'Address', 'School Organization', 'Sex', 'Birthdate', 'Contact Number', 'Email', 'Password', 'Status', 'Date Profile Update', 'Date Password Update', 'User Access');
fputcsv($file, $headers, "\t");

// Write data rows to the Excel file
while ($row_data = mysqli_fetch_assoc($result)) {
    fputcsv($file, $row_data, "\t");
}

// Close the file pointer
fclose($file);

// Close database connection
mysqli_close($db);

?>