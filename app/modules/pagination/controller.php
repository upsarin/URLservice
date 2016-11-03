<?php

//модуль для построения пагинации

Class pagination {

	public $model;
	public $view;
	
	
	
	function __construct()
	{
		$this->view = new PaginationView();
		$this->model = new PaginationModel(); 
	
	}
	
	// действие (action), вызываемое по умолчанию
	
	 
	public function index($page, $array, $post, $settings)
	{	
		
		$data = $this->model->pagination($array, $page, $settings);
		$this->view->generate($array['temp'] .'.php', $page, $data, $array);
	}
}