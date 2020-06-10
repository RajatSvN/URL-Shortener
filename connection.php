<?php
$mysqli = new mysqli("localhost","db_username","db_password","db_name");
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }
?>