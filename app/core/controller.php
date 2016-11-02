<?php
Class Controller {

	public $model;
	public $view;
	//public $modules;
	
	
	function __construct()
	{
		$this->view = new View();
		$this->model = new Model();
		//$this->modules = new minc();
	}
	
	// действие (action), вызываемое по умолчанию
	
	public function showPage($page)
	{
		$page_info = DBConnect::init()->selectPage($page);
		return $page_info;
	}
	
	public function index($array)
	{	
		if($_SESSION['user']['permissions'] > $array['permission']) {
			if($array['name'] == 'administrator'){
				echo minc::pos('admin-login', $array['id']);
			} else {
				header("Location: /");
			}		
		
		} else {
			
			$data = $this->model->get_data($array);
			$this->view->generate($array['temp'] .'_view.php', $array['template_type'] .'_view.php', $data, $array['id']); 
		}
		
	} 
	
	public function detail($array)
	{	
		User::permission($array['permission']);
		$data = $this->model->get_data_one($array);
		$this->view->generate($array['temp'] .'_view.php', $array['template_type'] .'_view.php', $data, $array['id']); 
	} 
	
	public function create($array)
	{	
		User::permission($array['permission']);
		$data = $this->model->create($array);
		$this->view->generate($array['temp'] .'_view.php', $array['template_type'] .'_view.php', $data, $array['id']); 
	}
	public function edit($array)
	{	
		User::permission($array['permission']);
		$data = $this->model->edit($array);
		$this->view->generate($array['temp'] .'_view.php', $array['template_type'] .'_view.php', $data, $array['id']); 
	}
	
	public function settings($array)
	{	
		User::permission($array['permission']);
		$data = $this->model->settings($array);
		
		$this->view->generate($array['temp'] .'_view.php', $array['template_type'] .'_view.php', $data, $array['id']); 
	}
	
	public function activate($array)
	{
		$data = $this->model->activate($array);
	}
	
	public function deactivate($array)
	{
		$data = $this->model->deactivate($array);
	}
	
	
}