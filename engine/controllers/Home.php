<?php

class Home extends Controller
{

  public function __construct($controller,$method)
  {
    parent::__construct($controller,$method);
  }

  public function indexMethod()
  {
    $this->_view->_show_view('home/index');
  }
}
