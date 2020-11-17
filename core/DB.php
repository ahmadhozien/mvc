<?php
/**
 *
 */
class DB
{
  private static $_instance;
  private $_mysql, $_query, $_error = false, $_result, $_count = 0, $_lastInsertId = null;

  private function __construct()
  {
    // init db connection
    if(DB_SERVER =="" && DB_ADMIN =="" && DB_PASSW =="" && DB_NAME =="")
		{
			$install_location = MAIN_PATH."/install";
			header("location:".$install_location."");
			exit();
		}
    else {
      $this->_mysql = new mysqli( DB_SERVER  ,  DB_ADMIN  , DB_PASSW , DB_NAME);
      if($this->_mysql->connect_errno > 0)
      {
        $install_location = MAIN_PATH."/install";
        header("location:".$install_location."");
        exit();
      }
      return $this->_mysql;
    }
  }

  public static function get_instance()
  {
    if(!isset(self::$_instance))
    {
      self::$_instance = new DB();
    }
    return self::$_instance;
  }

  public function query($q_string, $params = [])
  {

    if($this->_query = $this->_mysql->prepare($q_string))
    {
      // binding the params
      if(count($params))
      {
        $types_string = '';
        for ($num=0; $num < count($params); $num++) { 
          $param_type =  gettype($params[$num])[0];
          $types_string .= $param_type;
        }

        $this->_query->bind_param($types_string, ...$params);
      }

      // executing the query
      if($this->_query->execute())
      {
        $results = $this->_query->get_result();
        if($results)
        {
          $this->_result = $results->fetch_array(MYSQLI_NUM);
        }
        $this->_count = $results->num_rows;
        $this->_lastInsertId = $this->_query->insert_id;
      }
      else {
        $this->_error = true;
      }
    }
    return $this;
  }

  public function error()
  {
    return $this->_error;
  }

  public function results()
  {
    return $this->_result;
  }

  public function _count()
  {
    return $this->_count;
  }

  public function insert($table, $fields = [])
  {
    $field_string = '';
    $values = [];

    // write the statment automaticly
    foreach ($fields as $field => $value) {
      $field_string .= '`'. $field . '` = ? ,';
      $values[] = $value;
    }
    $field_string = rtrim($field_string, ',');
    $sql = "INSERT INTO `{$table}` SET {$field_string}";
    if(!$this->query($sql,$values)->error())
    {
      return true;
    }
    else {
      return false;
    }
  }


  public function update($table, $id, $fields = [])
  {
    $field_string = '';
    $values = [];

    // write the statment automaticly
    foreach ($fields as $field => $value) {
      $field_string .= '`'. $field . '` = ? ,';
      $values[] = $value;
    }
    $field_string = rtrim($field_string, ',');
    $sql = "UPDATE `{$table}` SET {$field_string} WHERE `id` = '$id'";
    if(!$this->query($sql,$values)->error())
    {
      return true;
    }
    else {
      return false;
    }
  }


  public function delete($table, $id)
  {
    $sql = "DELETE FROM `{$table}` WHERE `id` = '$id'";
    if(!$this->query($sql)->error())
    {
      return true;
    }
    else {
      return false;
    }
  }

  protected function _read($table, $params = [])
  {
    $condtion_string = '';
    $bind = [];
    $order = '';
    $limit = '';

    // fetch conditions 
    if(isset($params['conditions']))
    {
      // remove the un needed words 
      str_replace('WHERE', '', $params['conditions']);

      if(is_array($params['conditions']))
      {
        foreach ($params['conditions'] as $condition => $key ) {
          $condtion_string .= ' '. $condition .' = '. $key . ' AND';
        }
        $condtion_string = trim($condtion_string);
        $condtion_string = rtrim($condtion_string, 'AND');
      }
      else
      {
        $condtion_string = $params['conditions'];
      }
      // set the condition string 
      if($condtion_string != '')
      {
        $condtion_string = "WHERE ". $condtion_string;
      }
    }

    // bind the data 
    if (array_key_exists('bind', $params)) {
      $bind = $params['bind'];
    }

    // the order by statment prepare 
    if(array_key_exists('order', $params))
    {
      $order = "ORDER BY ". $params['order'];
    }

    // the limit statment prepare 
    if(array_key_exists('limit', $params))
    {
      $limit = "LIMIT ". $params['limit'];
    }

    // the sql query prepare 
    $sql = "SELECT * FROM {$table} {$condtion_string} {$order} {$limit}";

    // call the sql function 
    if($this->query($sql, $bind))
    {
      if(!count($this->_result))
      {
        return false;
      }
      else
      {
        return true;
      }
    }
  }

  public function find($table, $params = [])
  {
    if($this->_read($table , $params))
    {
      return $this->results();
    }
    else
    {
      return false;
    }
  }

  
}
