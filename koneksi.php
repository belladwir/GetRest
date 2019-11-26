<?php
//database_connection.php
$conn = mysqli_connect('localhost', 'root', '', 'gorest');
  if (!$conn) {
    die('Connection failed ' . mysqli_error($conn));
  }
?>