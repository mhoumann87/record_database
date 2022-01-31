<?php

// Connect to the database
function db_connect()
{
  $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  confirm_db_connect($connection);
  return $connection;
}

// Check the database connection
function confirm_db_connect($connection)
{
  if ($connection->connect_errno) {
    $msg  = 'Database connection failed: ';
    $msg .= $connection->error;
    $msg .= ' ('.$connection->errno.')';
    exit($msg);
  }
}

// Close the database connection
function db_disconnect($connection)
{
  if (isset($connection)) {
    $connection->close();
  }
}