<?php
  /**
   * establishing the router class
   */
  class Router
  {

    public static function route($url)
    {
      // define the controller
      $controller = (isset($url[0]) && !empty($url[0])) ? ucwords($url[0]) : DEFAULT_CONTROLLER;
      array_shift($url); //  deleting the url[0] index to remove the controller name from array

      // define the method
      $method = (isset($url[0]) && !empty($url[0])) ? $url[0].'Method' : 'indexMethod';
      array_shift($url); //  deleting the url[0] index to remove the method action from array

      // get the params
      $params = $url;

      // define the general object caller
      $general_object = new $controller($controller,$method); //  this will call the class where named after the controller name

      // check if this method exists
      if(method_exists($controller,$method))
      {
        // this function will call any method of any controller
        call_user_func_array(array($general_object,$method),$params);
      }
      else
      {
        die('method '.$method.' is not exists in controller '.$controller);
      }
    }

    // routing function 
    public static function redirect($location)
    {
      $location = ROOT.'/'.$location;
      if(!headers_sent())
      {
        header("location : ".$location." ");
        exit();
      }
      else
      {
        $redirection = '<script>';
        $redirection.= 'location.assign('.$location.')';
        $redirection.= '</script>';
        echo $redirection;
      }
    }
  }
