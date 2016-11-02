<?php

Class minc
{
	static function pos($pos=null, $page=null, $filter = null)
	{
		
			$module = DBConnect::init()->getModules($pos, $page);
			$module_folder = "app/modules/". $module['module_name'];
			$controller = $module_folder ."/controller.php";
			$model = $module_folder ."/model.php";
			$view = $module_folder ."/view.php";
		
		
		
			if(file_exists($controller)){
				include_once $controller;
				include_once $model;
				include_once $view;
				$plugin = $module['module_name'];
				if(isset($_REQUEST['module']) && isset($_REQUEST['module'])){
					if($_REQUEST['module'] == $plugin){
						$action = $_REQUEST['action'];
						$post[$module['module_name']] = $_REQUEST;
					} else {
						$action = "index";
						$post = null;
					}
				} else {
					$action = "index";
					$post = null;
				}
				try{
					$mod_obj = new $plugin;
				} catch (Exception $e){}
					
					if($module['chain'] == "Y"){
						
						$chain = explode(",", $module['chain_elements']);
						if(!is_array($chain)){
							$chain = array($module['chain_elements']);
						}
						$module['chain_modules'] = DBConnect::init()->getModules(NULL, NULL, $chain);
					}
					if($module['pos'] == "left-menu"){
					
					}
					
					$mod_obj->$action($page, $module, $post, $filter);
			} else {
				return "Такого модуля не существует";
			}
		
		
	}
	
}