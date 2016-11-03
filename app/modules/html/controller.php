<?php
//недоделан до конца
//модуль для показа html

Class html {

	public $model;
	public $view;
	
	
	
	function __construct()
	{
		$this->view = new HtmlView();
		$this->model = new HtmlModel();
	
	}
	
	// действие (action), вызываемое по умолчанию
	
	
	public function index($page, $array)
	{	
		$data = $this->model->get_data($array);
		$this->view->generate($array['temp'] .'.php', $page, $data, $array);
	}
	
	
}