<?php 

/**
 * 
 */
class Validation
{
  private $_valid = false, $_errors = [], $_db;
  function __construct()
  {
    $this->_db = DB::get_instance();
  }

  public function check($conditions = [])
  {
    $this->_errors = [];
    foreach ($conditions as $condition => $rules) {
      $data_item = Input::get($condition);
      foreach ($rules as $rule => $value) {
        $type  = array_key_exists("type",$rules) ? $rules['type'] : 'string';
        $required = array_key_exists("required",$rules) ? $rules['required'] : false;
        $min = array_key_exists("min",$rules) ? $rules['min'] : 0;
        $max = array_key_exists("max",$rules) ? $rules['max'] : 255;
      }
    }
  }

  public function valid()
  {
    return true;
  }
}
?>