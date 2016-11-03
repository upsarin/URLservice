<?php

//модуль по построению меню

Class menu {

	public $model;
	public $view;
	
	
	
	function __construct()
	{
		$this->view = new ModView();
		$this->model = new ModModel();
	
	}
	
	// действие (action), вызываемое по умолчанию
	
	
	public function index($page, $array)
	{	
		$data = $this->model->get_data($array);
		$this->view->generate($array['temp'] .'.php', $page, $data, $array);
	}
	
	
	
	
}