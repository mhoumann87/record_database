<?php

/* Check to see if user is logged in for Admin Pages */
function require_login()
{
  global $session;
  if (!$session->is_logged_in()) {
    redirect_to('/admin/login.php');
  }
}

/* Display errors on pages  */
function display_errors($errors = array())
{
  $output = '';
  if (!empty($errors)) {
    $output .= '<div class="errors">';
    $output .= '<h3>Please fix the following errors</h3>';
    $output .= '<ul>';
    foreach ($errors as $error) {
      $output .= '<li>.h($error).</li>';
    }
    $output .= '</ul>';
    $output .= '</div>';
  }
  return $output;
}
