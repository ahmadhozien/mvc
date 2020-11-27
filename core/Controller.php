<?php
 class Controller extends Engine{
   protected $_controller, $_method;
   public $_view;

   public function __construct($controller,$method)
   {
     parent::__construct();
     $this->_controller = $controller;
     $this->_method = $method;
     $this->_view = new View();
   }

   protected function load_model($model)
   {
   	if(class_exists($model))
   	{
   		$this->{$model.'Model'} = new $model(strtolower($model));
   	}
   }
 }
