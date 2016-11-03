<?php

//модуль авторизации, также ответственнен за logout пользователя

Class login {

	public $model;
	public $view;
	
	
	
	function __construct()
	{
		$this->view = new LoginView();
		$this->model = new LoginModel();
	
	}
	
	// действие (action), вызываемое по умолчанию
	
	
	public function index($page, $array)
	{	
		$data = $this->model->get_data($array);
		$this->view->generate($array['temp'] .'.php', $page, $data, $array);
	}
	//
	
	public function login_user($page, $array, $post)
	{	
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		$data = $this->model->login_user($page, $array, $post);
		
		if($routes[1] == 'administrator' && $data[0]['permissions'] < 5 ){
			header("Location: /administrator/");
		} else { 
			$this->view->generate("login" .'.php', $page, $data, $array);
		}
		
	}
	
	public function logout_user($page, $array, $post)
	{	
		$routes = explode('/', $_SERVER['HTTP_REFERER']);
		$data = $this->model->logout_user();
		if($routes[1] == 'administrator'){
			if($data){
				header("Location: /administrator/");
			}
		} else {
			if($data){
				header("Location: /");
			}
		}
		
		
		
	}
	
	
}