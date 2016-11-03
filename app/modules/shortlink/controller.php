<?php

//модуль коротких ссылок, отвечает за урезания длинных ссылок и превращение их в более комфортный вид

Class shortlink {

	public $model;
	public $view;
	
	
	
	function __construct()
	{
		$this->view = new ShortlinkView();
		$this->model = new ShortlinkModel(); 
	
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
			History("-1");
			//задать шаблон для ошибки
		} else {
			
			echo $data['mess'];
			//редиректит только по имени (alias) страницы! НЕ ПО ID!!!
			if($array['reload'] == 1 && $_REQUEST['ajax'] != "Y"){
				
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
	
	
}