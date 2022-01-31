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

/* Function to redirect to another page */
function redirect_to($location)
{
  header('Location: ' . $location);
  exit();
}