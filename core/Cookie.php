<?php 
/**
 * 
 */
class Cookie
{
	
	public static function _exists($name)
	{
		return isset($_COOCKIE[$name]) ? true : false;
	}

	public static function _get($name)
	{
		return $_COOKIE[$name];
	}

	public static function _set($name, $value, $expiry)
	{
		if(setCookie($name, $value, time() + $expiry, '/'))
		{
			return true;
		}

		return false;
	}

	public static function _delete($name)
	{
		self::_set($name,'', time()-1);
	}

	
}
?>
