<?php

/* Function to redirect to another page */
function redirect_to($location)
{
  header('Location: ' . $location);
  exit();
}