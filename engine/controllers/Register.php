<?php

class Register extends Controller
{

  public function __construct($controller,$method)
  {
    parent::__construct($controller,$method);
    $this->_view->set_layout('default');
  }

  public function indexMethod()
  {
    $this->loginMethod();
  }

  public function loginMethod()
  {
  	$this->_view->_show_view('register/login');
  }
}
