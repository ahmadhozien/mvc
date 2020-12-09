<?php 

/**
 * 
 */
class Input
{
	
	public static function filter($txt)
	{
		htmlentities($txt, ENT_QUOTES, "UTF-8");
	}

	public static function get($input)
	{
		if(isset($_REQUEST[$input]))
		{
			return self::filter($_REQUEST[$input]);
		}
	}
}
?>