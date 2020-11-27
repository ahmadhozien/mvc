<?php
/**
 * 
 */
class Users extends Model
{
	
	private $_logged_in, $_session_name, $_coockie_name;
	public static $current_user;

	public function __construct($user = '')
	{
		$table = 'users';
		parent::__construct($table);
		$this->_session_name = USER_SESSION;
		$this->_coockie_name = COOKIE_NAME;
		// this option doesn't delete the field from db but just hide it.
		$this->soft_delete = true;
		if(isset($user) && $user != '')
		{
			$user_from_db = $this->find(['conditions' => 'id = ?', 'bind' => [1]]);
		}
		if($user_from_db)
		{
			foreach ($user_from_db as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	public function find_user_by($type,$value)
	{
		$type = str_replace(' ', '', $type);
		return $this->find(['conditions' => '{$type} = ?', 'bind' => $value]);
	}

	public function login($rememberMe = false)
	{
		Session::_set($this->_session_name, $this->id);
		if($rememberMe)
		{
			$hash = md5(uniqid() + rand(0,120));
			$user_agent = Session::_uagent();
			Cookie::_set($this->_coockie_name, $hash, REMEMBER_ME_EXPIRY);
			$fields = ['session' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id];
			$this->_db->query('DELETE FROM `user_sessions` WHERE `user_id` = ? AND `user_agent` = ?',[$this->id,$user_agent]);
			$this->_db->insert('user_sessions', $fields);
		}
	}
}
?>