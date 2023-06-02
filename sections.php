<?php
session_start();
include "connection.php";
include "navbar.php";



?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .pagination a {
      color: black;
      padding: 8px 16px;
      text-decoration: none;
      transition: background-color 0.3s;
    }

    .pagination a.active {
      background-color: #4CAF50;
      color: white;
    }

    .pagination a:hover:not(.active) {
      background-color: #ddd;
    }

    .borrow_button {
      background-color: #4CAF50;
      color: white;
      padding: 8px 16px;
      text-decoration: none;
      transition: background-color 0.3s;
      text-align: center;
    }
  </style>
</head>

<body>
  <main>
    <section class="resources_section">
      <div class="resources-text-container">
        <h1>Catalog</h1>
        <p class="resources-text">Welcome to our Resouces page!
          Here, you can browse our extensive catalog
          of books with ease. Simply use the search bar or
          browse through the categories to find your next
          great read. Happy reading!<br><br>
          Note: You have to login first before reserving for a book.
        </p><br>

      </div>
      <div class="search_resources">
        <!-- form -->

        <form method="GET" action="">
          <div class="form-group">
            <label for="title">Book Title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
          </div>
          <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" class="form-control" id="author" name="author" placeholder="Enter author">
          </div>
          <div class="form-group">
            <label for="publisher">Publisher:</label>
            <input type="text" class="form-control" id="publisher" name="publisher" placeholder="Enter publisher">
          </div>

          <button type="submit">Search</button>
        </form>

        <?php
        // Define the number of records to display per page
        $recordsPerPage = 10;

        // Fetch total number of rows from the "library_books" table
        $sql = "SELECT COUNT(*) AS total FROM library_books";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        $totalRecords = $row['total'];

        // Calculate the total number of pages
        $totalPages = ceil($totalRecords / $recordsPerPage);

        // Get the current page number from the URL
        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

        // Calculate the offset for the SQL query
        $offset = ($currentPage - 1) * $recordsPerPage;

        // Get the search keywords from the form inputs
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $author = isset($_GET['author']) ? $_GET['author'] : '';
        $publisher = isset($_GET['publisher']) ? $_GET['publisher'] : '';

        // Create the SQL query with pagination and search conditions
        $sql = "SELECT * FROM library_books";

        if (!empty($title)) {
          $sql .= " WHERE title LIKE '%$title%'";
        }

        if (!empty($author)) {
          $sql .= " WHERE author LIKE '%$author%'";
        }

        if (!empty($publisher)) {
          $sql .= " WHERE publisher LIKE '%$publisher%'";
        }

        $sql .= " LIMIT $offset, $recordsPerPage";

        // Fetch data from the "library_books" table with pagination and search
        $result = mysqli_query($db, $sql);

        // Check if any rows are returned
        if (mysqli_num_rows($result) > 0) {
          echo '<table>
    <thead>
      <tr>
        <th>Access Number</th>
        <th>Class Number</th>
        <th>Author</th>
        <th>Title</th>
        <th>Edition</th>
        <th>Publisher</th>
        <th>Section</th>
      </tr>
    </thead>
    <tbody>';

          // Loop through each row of data
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['acc_number'] . '</td>
      <td>' . $row['class_number'] . '</td>
      <td>' . $row['author'] . '</td>
      <td>' . $row['title'] . '</td>
      <td>' . $row['edition'] . '</td>
      <td>' . $row['publisher'] . '</td>
      <td>' . $row['section'] . '</td>
      <td><div class="borrow_button"><a href="book_reservation.php?book_id=' . $row['acc_number'] . '">Borrow</a></div></td>'; // Borrow link/button
            echo '</tr>';
          }

          echo '</tbody>
    </table>';

          // Display pagination links
          echo '<div class="pagination">';
          for ($page = 1; $page <= $totalPages; $page++) {
            echo '<a href="?page=' . $page . '&title=' . $title . '&author=' . $author . '&publisher=' . $publisher . '" class="' . ($page == $currentPage ? 'active' : '') . '">' . $page . '</a>';
          }
          echo '</div>';
        } else {
          echo 'No available books found.';
        }

        // Close the database connection
        mysqli_close($db);
        ?>



    </section>



    <!--------------------Footer Section---------------------------------------->
    <?php include "footer.php"; ?>

</body>

</html>