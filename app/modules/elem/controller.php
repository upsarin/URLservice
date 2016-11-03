<?php
//устаревший модуль показа отдельных элементов, был заменен, но не удален
Class elem {

	public $model;
	public $view;
	
	
	
	function __construct()
	{
		$this->view = new ElementView();
		$this->model = new ElementModel();
	
	}
	
	// действие (action), вызываемое по умолчанию
	
	
	public function index($page, $array)
	{	
		$data = $this->model->get_data($array);
		$this->view->generate($array['temp'] .'.php', $page, $data, $array);
	}
	
	
}