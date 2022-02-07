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
      $this->id = self::$db->insert_id;
    }

    return $result;
  }// end create()
}// End DatabaseObject