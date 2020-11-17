<?php

class Home extends Controller
{

  public function __construct($controller,$method)
  {
    parent::__construct($controller,$method);
  }

  public function indexMethod()
  {
    $db = DB::get_instance();
    $fields = ['01001130309','Ahmed Updated'];
    $show  = $db->query("SELECT * FROM `users`");
    print_r($show->results()); 
    $myres = $show->results();
    foreach ($myres as $key => $value) {
      echo $key . ':' . $value . ' <br/> ';
    }
    
    $browser = get_browser(null, true);
print_r($browser);
    // $users = $db->find('users', [
    //   'conditions' => ['phone' => '?', 'name' => '?'],
    //   'bind' => ['01001130309','Ahmed Updated'],
    //   'order' => 'id', 
    //   'limit' => 5
    // ]);
    // print_r($users);
    $this->_view->_show_view('home/index');
  }
}
