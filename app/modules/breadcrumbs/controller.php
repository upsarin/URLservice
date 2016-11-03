<?php
//модуль хлебных крошек
Class breadcrumbs {

	public $model;
	public $view;
	
	
	
	function __construct()
	{
		$this->view = new BreadcrumbsView();
		$this->model = new BreadcrumbsModel(); 
	
	}
	
	// действие (action), вызываемое по умолчанию
	
	 
	public function index($page, $array, $post, $settings)
	{	
		
		$data = $this->model->breadcrumbs($array, $page, $settings);
		$this->view->generate($array['temp'] .'.php', $page, $data, $array);
	}
}