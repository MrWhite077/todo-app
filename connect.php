<?php
$server = 'localhost';
$username = 'root';
$password = '';
$db_name = 'todo list';

$conn = new mysqli($server, $username, $password, $db_name);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";
  ?>