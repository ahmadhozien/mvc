<?php

class Engine {

	// start the class automaticly
	public function __construct()
	{
		$this->_set_reporting();
	}

	private function _set_reporting()
	{
		if(DEBUGGING)
		{
			error_reporting(E_ALL); //  report all error, warnings and notices
			ini_set("display_errors", 1); //  show the errors in the browser
		}
		else {
			error_reporting(0); //  display report all errors
			ini_set("display_errors", 0); //  hide the errors in the browser
			ini_set('log_errors',1); //  activate the error logger text file
			ini_set('error_log', ROOT.'/logs/error_log.txt');
		}
	}
}
