<?php
// Database connection details
include "connection.php";

// Fetch data from the attendance table
$sql = "SELECT control_number, age, sex, school_organization, time_in FROM attendance";
$result = $db->query($sql);

// Create the CSV file
$filename = 'attendance_data.csv';

// Set headers for CSV file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Create a file pointer
$file = fopen('php://output', 'w');

// Write headers to the CSV file
$headers = array('Control Number', 'Age', 'Sex', 'School Organization', 'Time In');
fputcsv($file, $headers);

// Write data rows to the CSV file
while ($row_data = $result->fetch_assoc()) {
    fputcsv($file, $row_data);
}

// Close the file pointer
fclose($file);

// Close database connection
$db->close();
?>