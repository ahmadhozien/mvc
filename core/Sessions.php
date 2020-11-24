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
}

?>