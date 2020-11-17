<?php 
/**
 * 
 */
class Model
{
	protected $_db, $_table, $_model_name, $soft_delete = false, $columns_names = [];
	public $id;

	function __construct($table)
	{
		$this->_db = DB::get_instance();
	}
}