<?php

class Register extends Controller
{

  public function __construct($controller,$method)
  {
    parent::__construct($controller,$method);
    $this->load_model('Users');
    $this->_view->set_layout('default');
  }

  public function indexMethod()
  {
    $this->loginMethod();
  }

  public function loginMethod()
  {
    if($_POST)
    {
      $validation = true;
      if($validation === true)
      {
        $user = $this->UsersModel->find_user_by('mail',$_POST['email']);
        if($user && verify_password(Input::get('password'), $user->password))
        {
          $remember = isset(Input::get('remember')) ? true : false;
          $user->login($remember);
          Router::redirect('');
        }
      }
    }
  	$this->_view->_show_view('register/login');
  }
}
