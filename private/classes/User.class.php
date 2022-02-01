<?php

class User extends DataObject
{
  public $user_id;
  public $username;
  public $first_name;
  public $last_name;
  public $email;
  public $is_admin;
  protected $hashed_password;
  public $password;
  public $confirm_password;
  protected $reset_hash;
  protected $created;
  protected $updated;
  protected $password_required = true;


public function _construct($args = [])
{
  $this->username = $args['username'] ?? '';
  $this->first_name = $args['first_name'] ?? '';
  $this->last_name = $args['last_name'] ?? '';
  $this->email = $args['email'] ?? '';
  $this->is_admin = $args['is_admin'] ?? '';
  $this->password = $args['password'] ?? '';
  $this->confirm_password = $args['confirm_password'] && '';
  $this->hashed_password = $args['hashed_password']  && '';
  $this->created = $args['created'] && '';
  $this->updated = $args['updated'] && '';
}

} // End class