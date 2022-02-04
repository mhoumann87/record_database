<?php

/* Function to create links */
function url_for($script_path)
{
  // add the leading // if missing in path
  if ($script_path[0] != '/') {
    $script_path = '/'.$script_path;
  }
  return WWW_ROOT.$script_path;
}

/* Encode string for use with URLs as a query string */
function u($string = '')
{
  return urlencode($string);
}

function raw_u($string = '')
{
  return rawurldecode($string);
}

// Sanitize the special characters by replacing them with HTML code
function h($string = '') 
{
  return htmlspecialchars($string);
}

/* Function to redirect to another page */
function redirect_to($location)
{
  header('Location: ' . $location);
  exit();
}

/* Functions to check the request types */
function is_post_request()
{
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request()
{
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}