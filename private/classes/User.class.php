<?php

class User extends DatabaseObject
{

  static protected $table_name = 'users';
  static protected $db_columns = [
    'user_id',
    'username',
    'first_name',
    'last_name',
    'email',
    'hashed_password',
    'created',
    'updated'
  ];

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
  $this->is_admin = $args['is_admin'] ?? 0;
  $this->password = $args['password'] ?? '';
  $this->confirm_password = $args['confirm_password'] && '';
  $this->hashed_password = $args['hashed_password']  && '';
  $this->created = $args['created'] && '';
  $this->updated = $args['updated'] && '';
}

/*
  * Function to validate input from user
*/
protected function validate()
{
  $this->errors = [];

  if (is_blank($this->username)) {
    $this->errors[] = 'Username can\t be empty';
  } elseif (!has_length($this->username, array('min' => 4))) {
    $this->errors[] = 'Username must be at least 4 characters'; 
  } elseif (!has_unique_entries('username', $this->username, $this->user_id ?? 0)) {
    $this->errors[] = 'Username is already in the database, please choose another or login';
  }

  if (is_blank($this->first_name)) {
    $this->errors[] = 'First name can\t be blank';
  }

  if (is_blank($this->last_name)) {
    $this->errors[] = 'Last name can\t be blank';
  }

  if (is_blank($this->email)) {
    $this->errors[] = 'Email can\t be blank';
  } elseif (!has_valid_email_format($this->email)) {
    $this->errors[] = 'Please enter a valid email address';
  } elseif (!has_unique_entries('email', $this->email, $this->user_id ?? 0)) {
    $this->errors[] = 'Email is already in use, please use another or login';
  }

  if (this->password_required) {

    if (is_blank($this->password)) {
      $this->errors[] = 'Password can\t be blank';
    } elseif (!has_length($this->password, array('min' => 8))) {
      $this->errors[] = 'Password must contain at least 8 characters';
    } elseif (!preg_match('/[A-Z]/', $this->password)) {
      $this->errors[] = 'Password must contain at least i uppercase letter';
    } elseif (!preg_match('/[a-z]/', $this->password)) {
      $this->errors[] = 'Password must contain at least 1 lowercase letter';
    } elseif (!preg_match('/[0-9]/', $this->password)) {
      $this->errors[] = 'Password must contain at least 1 number';
    }

    if (is_blank($this->confirm_password)) {
      $this->errors[] = 'Confirm password can\t be blank';
    } elseif ($this->confirm_password !== $this->password) {
      $this->errors[] = 'Password and confirm password must be the same';
    }
  }// end password_required

  return $this->errors;
} // End validate()

/*
  * Hash the password before entering it to the database 
*/
protected function set_hashed_password()
{
  $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
}

/*
  * Check password on login
*/
public function verify_password($password)
{
  return password_verify($password, $this->hashed_password);
}

/* 
 * Create a new user with all the entered information 
*/
protected function create()
{
  $this->set_hashed_password();
  return parent::create();
}

/*
  * On edit, if password is entered (changed)
  * hash the new password
*/
protected function update()
{
  if ($this->password != '') {
    // Validate password
    $this->set_hashed_password();
  } else {
    // Password not changed, skip hashing  and validation
    $this->password_required = false;
  }

  return parent::update();
}

/*
 * Set the information about when entry is created and updated
*/
public function set_created_at()
{
  $this->created = time();
}

public function set_updated_at()
{
  $this->updated = time();
}

/*
 *  Function to find user by column 
*/
static public function find_by_column($column, $value)
{
  $sql  = "SELECT * FROM ".static::$table_name." ";
  $sql .= "WHERE ".$column."='".self::$db->escape_string($value)."'";

  $obj_array = static::find_by_sql($sql);

  if (!empty($obj_array)) {
    return array_shift($obj_array);
  } else {
    return false;
  }
}

/*
 * Utility function to show full name for a user
*/
public function show_full_name()
{
  return "{$this->first_name} {$this->last_name}";
}



} // End class