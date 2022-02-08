<?php

class DatabaseObject
{
  static protected $db;
  static protected $table_name = '';
  static protected $columns = [];
  public $errors = [];

  static public function set_database($db)
  {
    self::$db = $db;
  }

  /*
    * CRUD operations 
  */

  // Create

  protected function create()
  {
    $this->validate();

    if (!empty($this->errors)) {
      return false;
    }

    $attributes = $this->sanitized_attributes();

    $sql  = "INSERT INTO ".static::table_name." (";
    $sql .= join(', ', array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";

    $result = self::$db->query($sql);

    if ($result) {
      $this->user_id = self::$db->insert_id;
    }

    return $result;
  }// end create()

  // Read

  static public function find_by_sql($sql)
  {
    $result = self::$db->query($sql);

    if (!result) {
      exit("Database query failed");
    }

    $object_array = [];

    // Convert the result in to an object
    while ($record = $result->fetch_assoc()) {
      $object_array[] = static::instantiate($record);
    }

    $result->free();
    return object_array();
  } // End find_by_sql()

  static public function find_all()
  {
    $sql = "SELECT * FROM ".static::$table_name;
    return static::find_by_sql($sql);
  } // end find_all()

  static public function find_by_id($id)
  {
    $sql  = "SELECT * FROM ".static::$table_name." ";
    $sql .= "WHERE user_id ='".self::$db->escape_string($id)."'";

    $object_array = static::find_by_sql($sql);

    if (!empty($object_array)) {
      return array_shift($object_array);
    } else {
      return false;
    }
  } // end find_by_id()

  // Update

  static public function update()
  {

  } // end update()
}// End DatabaseObject