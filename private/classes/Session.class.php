<?php

class Session
{
  public $user_id;
  public $username;
  private $last_login;

  public const MAX_LOGIN_AGE = 60 * 60 * 24 * 7; // one week

public function __construct()
{
  session_start(); // turn on the session when a new session is initializes
  $this->check_stored_login();
}

private function check_stored_login()
{
  if (isset($_SESSION['user_id'])) {
    $this->user_id = $_SESSION['user_id'];
    $this->username = $_SESSION['username'];
    $this->last_login = $_SESSION['last_login'];
  }
}

} // End Session 

