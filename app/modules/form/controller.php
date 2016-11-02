<?php
Class form {

	public $model;
	public $view;
	
	
	
	function __construct()
	{
		$this->view = new ContentView();
		$this->model = new ContentModel(); 
	
	}
	
	// действие (action), вызываемое по умолчанию
	
	 
	public function index($page, $array)
	{	
		
		$data = $this->model->get_data($array, $page);
		$this->view->generate($array['temp'] .'.php', $page, $data, $array);
	}
	
	public function save_data($page, $array, $post)
	{	
		
		$data = $this->model->save_data($page, $array, $post);
		if(isset($data['error']) && !empty($data['error'])){
			echo $data['error'];
			echo "<a href='javascript:void(window.history(-1))'>назад</a>";
			//задать шаблон для ошибки
		} else {
			echo $data['mess'];
			//редиректит только по имени(alias) страницы! НЕ ПО ID!!!
			if($array['reload'] == 1){
				$phrase = '?phrase='. $data['mess'];
				$routes = explode('/', $_SERVER['HTTP_REFERER']);
				
				if(($routes[5] == "create" && $routes[4] == "content") || $routes[2] == "content"){
					Redirect(null, $phrase, $_SERVER['HTTP_REFERER']);
				} else {
					Redirect($page, $phrase);
				}
				
			}
		
		}
	}
	public function update_data($page, $array, $post)
	{	
		
		$data = $this->model->update_data($page, $array, $post);
		if(isset($data['error']) && !empty($data['error'])){
			echo $data['error'];
			echo "<a href='javascript:void(window.history(-1))'>назад</a>";
			//задать шаблон для ошибки
		} else {
			echo $data['mess'];
			//редиректит только по имени(alias) страницы! НЕ ПО ID!!!
			if($array['reload'] == 1){
				$phrase = '?phrase='. $data['mess'];
				
				History("-2");
				//Redirect($page, $phrase);
			}
		
		}
		
	}
	
	public function save_fields($page, $array, $post){
		$data = $this->model->save_fields($page, $array, $post);
		Redirect('edit_fields', null, $_SERVER['HTTP_REFERER']);
		
	}
	public function save_user($page, $array, $post)
	{	
		
		$data = $this->model->save_user($page, $array, $post);
		if(isset($data['error']) && !empty($data['error'])){
			echo $data['error'];
			echo "<a href='javascript:void(window.history(-1))'>назад</a>";
			//задать шаблон для ошибки
		} else {
			echo $data['mess'];
			//редиректит только по имени(alias) страницы! НЕ ПО ID!!!
			if($array['reload'] == 1){
				$phrase = '?phrase='. $data['mess'];
				Redirect($page, $phrase);
			}
		
		}
	}
	public function update_user($page, $array, $post)
	{	
		
		$data = $this->model->update_user($page, $array, $post);
		if(isset($data['error']) && !empty($data['error'])){
			echo $data['error'];
			echo "<a href='javascript:void(window.history(-1))'>назад</a>";
			//задать шаблон для ошибки
		} else {
			echo $data['mess'];
			//редиректит только по имени(alias) страницы! НЕ ПО ID!!!
			if($array['reload'] == 1){
				$phrase = '?phrase='. $data['mess'];
				Redirect($page, $phrase);
			}
		
		}
	}
	
}