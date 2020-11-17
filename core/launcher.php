<?php
  require_once(ROOT.'/config/config.php');
  require_once(ROOT.'/config/db_config.php');

  // auto load classes from objects
  spl_autoload_register(function($class_name)
    {
      if(file_exists(CORE_PATH.'/'.$class_name.'.php'))
      {
        require(CORE_PATH.'/'.$class_name.'.php');
      }
      else if(file_exists(ENGINE_PATH.'/controllers/'.$class_name.'.php'))
      {
        require(ENGINE_PATH.'/controllers/'.$class_name.'.php');
      }
      else if(file_exists(ENGINE_PATH.'/models/'.$class_name.'.php'))
      {
        require(ENGINE_PATH.'/models/'.$class_name.'.php');
      }
    }
  );
  // call the router class and route method
  Router::route($url);
