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
		$this->_table = $table;
		$this->_setTableColumns();
		$this->_model_name = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
	}

	protected function _setTableColumns()
	{
		$columns = $this->get_columns();
		foreach ($columns as $column) {
			$columnName = $column->Field;
			$this->_columns_names[] = $column->Field;
			$this->{$columnName} = null;
		}
	}

	public function get_columns()
	{
		return $this->_db->get_columns($this->_table);
	}

	// resolves the db find mthod 
	public function find($params =[])
	{
		$results = [];
		$results_from_db = $this->_db->find($this->_table, $params);
		foreach ($results_from_db as $db_result) {
			echo $db_result;
			
		}
		return $results;
	}

	// detect type of action whether insert or update and call it
	public function save()
	{
		$data = [];
		foreach ($this->_columns_names as $column) {
			$data[$column] = $this->column;
		}

		if(property_exists($this, $id) && $this->id != '')
		{
			return $this->update($data, $this->id);
		}
		else 
		{
			return $this->insert($data);
		}
	}

	public function insert($data)
	{
		if(empty($data)) return false;
		return $this->_db->insert($this->_table, $data);
	}

	public function update($data, $id)
	{
		if(empty($data) || $id == '') return false;
		return $this->_db->update($this->_table, $id, $data);
	}

	public function delete($id = '')
	{
		if($id == '' || $this->id == '') return false;
		$id = $id == '' ? $this->id : $id;
		if($this->soft_delete)
		{
			return $this->update(['deleted' => 1], $id);
		}
		return $this->_db->delete($this->_table, $id);
	}

	public function query($query,$data = [])
	{
		return $this->_db->query($query, $data);
	}

	public function data()
	{
		$_data = new stdClass();
		foreach ($this->_columns_names as $column) {
			$_data->column = $this->column;
		}
		return $_data;
	}

	public function assign($data)
	{
		if(!empty($data))
		{
			foreach ($data as $key => $value) {
				if(in_array($key, $this->_columns_names))
				{
					$this->$key = htmlentities($value, 'ENT_QUOTES', 'UTF-8');
				}
			}
			return true;
		}
		return false;
	}
}