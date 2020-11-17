<?php

/**
* Licenced by Ahmad Hozien.
* Github @ahmadhozien
*/

class View
{

  protected $_head, $_body, $_siteTitle = SITE_NAME, $_outputBuffer, $_layout = DEFAULT_LAYOUT;

  public function __construct()
  {

  }

  public function _show_view($view)
  {
    $view = str_replace('\/','/',$view);
    if(file_exists(ENGINE_PATH.'/views/'.$view.'.php'))
    {
      include(ENGINE_PATH.'/views/'.$view.'.php');
      include(ENGINE_PATH.'/views/layouts/'.$this->_layout.'.php');
    }
    else {
      die('this view '.$view.' is not exists.');
    }
  }

  public function _content($type)
  {
    if($type == 'head')
    {
      return $this->_head;
    }
    else if($type == 'body')
    {
      return $this->_body;
    }
    return false;
  }

  public function start($type)
  {
    $this->_outputBuffer = $type;
    ob_start();
  }

  public function end()
  {
    if($this->_outputBuffer == 'head')
    {
      $this->_head = ob_get_clean();
    }
    else if($this->_outputBuffer == 'body')
    {
      $this->_body = ob_get_clean();
    }
    else{
      die('you must use start method first');
    }
  }

  public function site_title()
  {
    return $this->_siteTitle;
  }

  public function set_site_title($title)
  {
    $this->_siteTitle = $title;
  }

  public function set_layout($route)
  {
    $this->_layout = $route;
  }
}
