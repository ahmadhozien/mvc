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
    $validation = new Validation();
    if($_POST)
    {
      $validation->check(
        [
          'email' => ['type' => 'email', 'required' => true, 'min' => 10, 'max' => 255],
          'password' => ['type' => 'string', 'required' => true, 'min' => 8, 'max' => 255]
        ]
      );
      if($validation->valid() == true)
      {
        $user = $this->UsersModel->find_user_by('mail',$_POST['email']);
        if($user && password_verify(Input::get('password'), $user['password']))
        {
          $remember =  null !== Input::get('remember') && Input::get('remember') ? true : false;
          $user->login($remember);
          Router::redirect('');
        }
      }
    }
  	$this->_view->_show_view('register/login');
  }
}
