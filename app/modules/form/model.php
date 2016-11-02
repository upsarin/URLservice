<?php

class ContentModel
{

	// метод выборки данных
	public function get_data($array, $page)
	{
		
		if(isset($page) && !empty($page)){
			//поля
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			$page_model = Element::GetByID($page, 'model', 'pages');
			$page_info['id'] = Element::GetByID($routes[4], 'page_id', 'content');
			$page_info['name'] = Element::GetByID($page_info['id'], 'name', 'pages');
			if($page == 'pages' || $page == 'users' || $page == 'cats')
			{
				if($page_model == 'administrator'){
					if($page != 'content'){
						$params = array("iblock" => $page, "active" => "Y");
						$sort = array("sort", "asc");
					}
					
				} else {
					$params = array("type" => $page, "active" => "Y");
					$sort = array("sort", "asc");
				}
				$array['FIELDS'] = DBConnect::init()->getFeilds($params, $sort);
				if($page_model == 'administrator'){
					if($page == 'content'){
						if(isset($_GET['model'])){
							$page_name = $_GET['model'];
						} else {
							$page_name = $page_info['name'];
						}
						$params_alter = array("field_type" => "alter", "active" => "Y", "type" => $page_name);
						$array['ALTER'] = DBConnect::init()->getFeilds($params_alter, $sort);
						$array['FIELDS'] = array_merge($array['FIELDS'], $array['ALTER']);
					}
				}
				//Р·РЅР°С‡РµРЅРёСЏ РїРѕР»РµР№
				
				if($page_model == 'administrator'){
					if(is_numeric($routes[4])){
						$id = $routes[4];
					}
				} else {
					if(is_numeric($routes[3])){
						$id = $routes[3];
					}
				}
				
				if(isset($id) && is_numeric($id)){
					if(count($array) > 0){
						if($array['FIELDS'][0]['iblock'] != 'content' && $array['FIELDS'][0]['iblock'] != 'login'){
							$params = array('id' => $id);
							$sort = array("sort", "asc");
							$table = $array['FIELDS'][0]['iblock'];
							$array['VALUES'] = DBConnect::init()->getFeildsValues($params, null, $table);
							
						} else {
							$params = array('id' => $id);
							
							$table = 'content';
							$array['VALUES'] = DBConnect::init()->getFeildsValues($params, null, $table);
						}
						
					}
					
				}
			}
			else 
			{
				if($page_model == 'administrator'){
					$params = array("type" => "base_content", "active" => "Y");
					$sort = array("sort", "asc");
					$array['FIELDS'] = DBConnect::init()->getFeilds($params, $sort);
						if(isset($_GET['model'])){
							$page_name = $_GET['model'];
						} else {
							$page_name = $page_info['name'];
						}
						$params_alter = array("field_type" => "alter", "active" => "Y", "type" => $page_name);
						$array['ALTER'] = DBConnect::init()->getFeilds($params_alter, $sort);
						$array['FIELDS'] = array_merge($array['FIELDS'], $array['ALTER']);
						if($page_model == 'administrator'){
							if(is_numeric($routes[4])){
								$id = $routes[4];
							}
						} else {
							if(is_numeric($routes[3])){
								$id = $routes[3];
							}
						}
				
						if(isset($id) && is_numeric($id)){
							if(count($array) > 0){
								if($array['FIELDS'][0]['iblock'] != 'content' && $array['FIELDS'][0]['iblock'] != 'login'){
									$params = array('id' => $id);
									$sort = array("sort", "asc");
									$table = $array['FIELDS'][0]['iblock'];
									$array['VALUES'] = DBConnect::init()->getFeildsValues($params, null, $table);
									
								} else {
									$params = array('id' => $id);
									
									$table = 'content';
									$array['VALUES'] = DBConnect::init()->getFeildsValues($params, null, $table);
								}
								
							}
							
						}
						
				} else {
							$params = array("type" => 'base_content', "active" => "Y");
							$sort = array("sort", "asc");
					$array['FIELDS'] = DBConnect::init()->getFeilds($params, $sort);
					
							$params_alter = array("field_type" => "alter", "active" => "Y", "type" => $page);
					$array['ALTER'] = DBConnect::init()->getFeilds($params_alter, $sort);
					$array['FIELDS'] = array_merge($array['FIELDS'], $array['ALTER']);
							
					if($routes[3] == 'create'){
						$array['action'] = "save_data";
					} else if($routes[3] == 'edit' && is_numeric($routes[4])){
						$array['action'] = "update_data";
					}
					if($routes[2] == 'create'){
						$array['action'] = "save_data";
					} else if($routes[2] == 'edit' && is_numeric($routes[3])){
						$array['action'] = "update_data";
					}
					if(is_numeric($routes[4])){
						$id = $routes[4];
					} else {
						if(is_numeric($routes[3])){
							$id = $routes[3];
						}
					}
							$table = 'content';
							$params = array('id' => $id);
					$array['VALUES'] = DBConnect::init()->getFeildsValues($params, null, $table);
					if(isset($id) && is_numeric($id)){
						if(count($array) > 0){
							foreach($array['FIELDS'] as $key => $val){
								if($val['field_type'] == 'main'){
									$array['FIELDS'][$key]['value'] = $array['VALUES'][0][$val['code']]; 
								} else {
									$params = array('element_id' => $id, 'code' => $val['code']);
									$field_value = Element::GetFeildsValues($params, null, 'field_value');
									$array['FIELDS'][$key]['value'] = $field_value[0]['value']; 
								}
							}
						}
					}
				}
			}
			
		}
		
		return $array;
	}
	
	public function save_data($page, $array, $post) 
	{
		 
		if(isset($post['form']['main']['cat']) && !empty($post['form']['main']['cat'])){
			$_SESSION['user']['last_cat'] = $post['form']['main']['cat'];
		}
		if(isset($post['form']['iblock_name']) && !empty($post['form']['iblock_name'])){
			if(isset($post['form']['iblock_name']) && $post['form']['iblock_name'] != 'content' && $post['form']['iblock_name'] != "cats"){
				
				$post['form']['main']['title'] = $post['form']['main']['title'];
				$post['form']['main']['name'] = strtolower(Element::Translit_rus($post['form']['main']['title']));
				if(isset($post['form']['iblock_name']) && $post['form']['iblock_name'] != 'content'){
					$post['form']['main']['model'] = strtolower(Element::Translit_rus($post['form']['main']['title']));
				}
				$post['form']['main']['alias'] = strtolower(Element::Translit_rus($post['form']['main']['title']));
			} else {
				if(isset($post['form']['main']['name'])){
					$post['form']['main']['name'] = $post['form']['main']['name'];
				}
				if(isset($post['form']['main']['alias'])){
					$post['form']['main']['alias'] = strtolower(Element::Translit_rus($post['form']['main']['name']));
				}
				if($post['form']['iblock_name'] == 'cats'){
					$post['form']['main']['active'] = "Y";
				}
				if($post['form']['iblock_name'] == 'content'){
					$table = "pages";
					$filter = array("model" => $post['form']['model']);
					$page_id = Element::SelectAll($table, $filter, null, null, "Y");
					$post['form']['main']['page_id'] = $page_id[0]['id'];
					$post['form']['main']['alias'] = strtolower(Element::Translit_rus($post['form']['main']['title']));
					$post['form']['main']['name'] = strtolower(Element::Translit_rus($post['form']['main']['title']));
					
					$post['form']['main']['active'] = "Y";
					
				}
				
			}
			
			
		} else {
			$post['form']['main']['alias'] = strtolower(Element::Translit_rus($post['form']['main']['title']));
			if(isset($post['form']['main']['title'])){
				$post['form']['main']['title'] = $post['form']['main']['title'];
			}
			if(isset($post['form']['main']['name'])){
				$post['form']['main']['name'] = strtolower(Element::Translit_rus($post['form']['main']['title']));
			}
			if(empty($post['form']['main']['active_from'])){
				$post['form']['main']['active_from'] = date("Y-m-d H:i:s");
			}
			if(empty($post['form']['main']['active'])){
				$post['form']['main']['active'] = "Y";
			}
			if(empty($post['form']['main']['cat'])){
				$post['form']['main']['cat'] = "0";
			}
			if(isset($post['form']['alter']) && count($post['form']['alter']) > 0){
				$post['form']['main']['fields'] = "Y";
			} 
			
			if(empty($post['form']['main']['user'])){
				$post['form']['main']['user'] = $_SESSION['user']['id'];
			}
			
			
			
			
		}
		
		
		$query = Element::SaveElementsWithImages(array($post['form']));
		if($query['confirm'] == true){
			
			if(!empty($_FILES['file']['name'][0])){
				Element::saveFile($query['id']);
			}
			if(!empty($array['confirm_phrase'])){
				$mess['mess'] = $array['confirm_phrase'];
			} else {
				$mess['mess'] = "Успешное сохранение.";
			}
			
		} else {
			if(!empty($array['error_phrase'])){
				$mess['mess'] = $array['error_phrase'];
			} else {
				$mess['mess'] = "Произошла ошибка при сохранении.";
			}
		}
		return $mess; 
		
	}
	public function update_data($page, $array, $post) 
	{
		
		if(isset($post['form']['main']['cat']) && !empty($post['form']['main']['cat'])){
			$_SESSION['user']['last_cat'] = $post['form']['main']['cat'];
		}
		if(isset($post['form']['iblock_name']) && !empty($post['form']['iblock_name'])){
			
			if(isset($post['form']['main']['title'])){
				$post['form']['main']['title'] = $post['form']['main']['title'];
				if(isset($post['form']['main']['name'])){
					$post['form']['main']['name'] = $post['form']['main']['title'];
				}
				if(isset($post['form']['main']['model'])){
					$post['form']['main']['model'] = strtolower(Element::Translit_rus($post['form']['main']['title']));
				}
				if(isset($post['form']['main']['alias'])){
					$post['form']['main']['alias'] = strtolower(Element::Translit_rus($post['form']['main']['title']));
				}
			} else {
				if(isset($post['form']['main']['name'])){
					$post['form']['main']['name'] = $post['form']['main']['name'];
				}
				if(isset($post['form']['main']['alias'])){
					$post['form']['main']['alias'] = strtolower(Element::Translit_rus($post['form']['main']['name']));
				}
				
			}
			
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			if($routes[1] == 'administrator'){
				if(is_numeric($routes[4])){
					$id = $routes[4];
				}
			}
			else 
			{
				if(is_numeric($routes[3])){
					$id = $routes[3];
				}
			}
			$where = array('id' => $id);
			$what = $post['form']['main'];
			$table = $post['form']['iblock_name'];
		} 
		else 
		{
			$post['form']['main']['alias'] = strtolower(Element::Translit_rus($post['form']['main']['title']));
			$post['form']['main']['title'] = $post['form']['main']['title'];
			$post['form']['main']['name'] = strtolower(Element::Translit_rus($post['form']['main']['title']));
			$post['form']['main']['active_from'] = date("Y-m-d H:i:s");
			$post['form']['main']['active'] = "Y";
			if(empty($post['form']['main']['cat'])){
				$post['form']['main']['cat'] = "0";
			}
			if(isset($post['form']['alter']) && count($post['form']['alter']) > 0){
				$post['form']['main']['fields'] = "Y";
			} 
			if(empty($post['form']['main']['user'])){
				$post['form']['main']['user'] = $_SESSION['user']['id'];
			}
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			if($routes[1] == 'administrator' || $routes[1] == 'personal'){
				if(is_numeric($routes[4])){
					$id = $routes[4];
				}
			}
			else 
			{
				if(is_numeric($routes[3])){
					$id = $routes[3];
				}
			}
			
			
			$where = array('id' => $id);
			$what = $post['form']['main'];
			$table = 'content';
			//Element::saveFile();
		}
		if(count($post['form']['alter']) > 0){
				
				$table_alter = 'field_value';
				
				foreach($post['form']['alter'] as $key => $val){
					
					$params = array('element_id' => $id, 'code' => $key);
					$field_alter_value = Element::GetFeildsValues($params, null, 'field_value');
					
					if(count($field_alter_value) > 0){
						$where_alter = array('element_id' => $id, 'code' => '"'. $key .'"');
						$what_alter = array('value' => $val);
						Element::Update($where_alter, $what_alter, $table_alter);
					} else {
						$code = $key;
						$value = $val;
						DBConnect::init()->emptyFieldSaveEdit($id, $code, $value);
						
					}
					
					
					
				}
				
		}
		
		if(Element::Update($where, $what, $table) == true){
			if(!empty($_FILES['file']['name'][0])){
				Element::saveFile($id);
			}
			if(!empty($array['confirm_phrase'])){
				$mess['mess'] = $array['confirm_phrase'];
			} else {
				$mess['mess'] = "Успешное сохранение.";
			}
		} else {
			if(!empty($array['error_phrase'])){
				$mess['mess'] = $array['error_phrase'];
			} else {
				$mess['mess'] = "Произошла ошибка при сохранении.";
			}
		}
		return $mess; 
		
	}
	public function save_fields($page, $array, $post) 
	{
		foreach($post['form']['alter'] as $key => $val){
			
			
			if($val['del'] == 'Y' && isset($post['form']['action_fields']) && !empty($post['form']['action_fields'])){
				if($post['form']['action_fields'] == 'del'){
					$where = array('id' => $key);
					$table = 'fields';
					Element::Delete($where, $table);
				} else if($post['form']['action_fields'] == 'activate'){
					$val['active'] = "Y";
					$where = array('id' => $key);
					$what = $val;
					$table = 'fields';
					Element::Update($where, $what, $table);
				} else if($post['form']['action_fields'] == 'deactivate'){
					$val['active'] = "N";
					$where = array('id' => $key);
					$what = $val;
					$table = 'fields';
					Element::Update($where, $what, $table);
				}
			} else {
			
				if(!isset($val['active'])){
					$val['active'] = "N";
				}
				if(!isset($val['readonly'])){
					$val['readonly'] = "N";
				}
				if(!isset($val['required'])){
					$val['required'] = "N";
				}
				$where = array('id' => $key);
				$what = $val;
				$table = 'fields';
				
				
				Element::Update($where, $what, $table);
				
			
			}
		}
		if(isset($post['form']['new']) && count($post['form']['new']) > 0){
			foreach($post['form']['new'] as $key => $val){
				if($val['input_type'] == 'checkbox'){
					$val['default_value'] = 'Y';
				}
				$val['type'] = $post['form']['page_id'];
				$val['multi'] = "N";
				$val['field_type'] = "alter";
				Element::saveField($val);
			}
		}
		$mess['field_success'] = "Сохранение прошло успешно";
		
		return $mess['field_success'];
	}
	public function save_user($page, $array, $post)
	{
		
		if(isset($post['form']['action']) && $post['form']['action'] == 'save_user'){
			//метод добавляющий пользователя в БД, и все его доп поля...
			
			if(isset($post['form']['main']['password_new']) && !empty($post['form']['main']['password_new'])){
				$post['form']['main']['password'] = $post['form']['main']['password_new'];
				unset($post['form']['main']['password_new']);
			} else {		
				unset($post['form']['main']['password_new']);
			}
			if(isset($post['form']['main']['permissions']) && !empty($post['form']['main']['permissions'])){
				$post['form']['main']['permissions'] = $post['form']['main']['permissions'];
			} else {
				$permissions = Element::SelectAll('user_groups', null, null, null);
				foreach($permissions as $key => $val){
					if($post['form']['main']['group'] == $val['name']){
						$post['form']['main']['permissions'] = $val['permissions'];
					}
				}
			}
			$post['form']['main']['hesh'] = md5($post['form']['main']['login']);
			
			$mess = DBConnect::init()->register_user($post['form']['main'], $post['form']['alter']);
			
			$array['mess'] = $mess;
			return $array;
		}
	}
	public function update_user($page, $array, $post)
	{
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			if($routes[1] == 'administrator' || $routes[1] == 'personal'){
				if(is_numeric($routes[4])){
					$id = $routes[4];
				}
			}
			else 
			{
				if(is_numeric($routes[3])){
					$id = $routes[3];
				}
			}
			if(isset($post['form']['main']['password_new']) && !empty($post['form']['main']['password_new'])){
				$post['form']['main']['password'] = md5($post['form']['main']['password_new']);
				unset($post['form']['main']['password_new']);
			} else {		
				unset($post['form']['main']['password_new']);
			}
			if(isset($post['form']['main']['permissions']) && !empty($post['form']['main']['permissions'])){
				$post['form']['main']['permissions'] = $post['form']['main']['permissions'];
			} else {
				$permissions = Element::SelectAll('user_groups', null, null, null);
				foreach($permissions as $key => $val){
					if($post['form']['main']['group'] == $val['name']){
						$post['form']['main']['permissions'] = $val['permissions'];
					}
				}
			}	
		foreach($post['form']['alter'] as $key => $val){
				
				$where = array('code' => "'". $key ."'", 'element_id' => $id, "iblock" => "'users'");
				$what = array('value' => $val);
				$table = 'field_value';
				
				Element::Update($where, $what, $table);
		}	
		
		$where = array('id' => $id);
		$what = $post['form']['main'];
		$table = 'users';
		if(Element::Update($where, $what, $table) == true){
			
			if(!empty($array['confirm_phrase'])){
				$mess['mess'] = $array['confirm_phrase'];
			} else {
				$mess['mess'] = "Успешное сохранение.";
			}
		} else {
			if(!empty($array['error_phrase'])){
				$mess['mess'] = $array['error_phrase'];
			} else {
				$mess['mess'] = "Произошла ошибка при сохранении.";
			}
		}
		return $mess;
	}
}