<?php
/**
* Licenced by Ahmad Hozien.
* Github @ahmadhozien
*/
  // start the session
  session_start();
  // get the root file path
  define('ROOT', dirname(__FILE__));

  // get the app url params into an array
  $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];

  // get the main path of project
  $main_path = explode('/',ltrim($_SERVER['REQUEST_URI']));
  $main_path = 'https://'.$_SERVER['SERVER_NAME'].'/'.$main_path['1'];

  // require the core files
  require_once(ROOT.'/'.'core/launcher.php');
?>
