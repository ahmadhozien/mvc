<?php

/**
 * 
 */
class Session
{
	
	public static function _exists($session_name)
	{
		return isset($_SEESSION[$session_name]) ? true : false; 
	}

	public static function _get($session_name)
	{
		return $_SEESSION[$session_name];
	}

	public static function _set($session_name, $value)
	{
		return $_SEESSION[$session_name] = $value;
	}

	public static function _delete($session_name)
	{
		if(self::_exists($session_name))
		{
			unset($_SEESSION[$session_name]);
		}
	}

	public static function _uagent()
	{
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$pattern = '/\/[a-zA-z0-9.]+/';
		return $agent = preg_replace($pattern, '', $agent);
	}
}

?>