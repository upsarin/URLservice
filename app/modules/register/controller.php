<?php

//модуль регистрации

Class register {

	public $model;
	public $view;
	
	
	
	function __construct()
	{
		$this->view = new RegView();
		$this->model = new RegModel();
	
	}
	
	// действие (action), вызываемое по умолчанию
	
	
	public function index($page, $array)
	{	
		if(isset($_REQUEST['hesh']))
		{ 
			$data = $this->model->activate($page, $array, $post); 
			$this->view->generate("activate" .'.php', $page, $data, $array);
		} else {
			$data = $this->model->get_data($array);
			$this->view->generate($array['temp'] .'.php', $page, $data, $array);
		}
	}
	
	
	public function save_register($page, $array, $post)
	{	
		$data = $this->model->save_data($page, $array, $post);
		$this->view->generate("success_register" .'.php', $page, $data, $array);
	}
	
	
	
	
}