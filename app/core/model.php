<?

class Model
{
	
	
	// метод выборки данных
	public function get_data($array)
	{
		
		
		
		
			if(isset($_POST['action'])){
				if($_POST['action'] == 'activate'){
					
					foreach($_POST['id'] as $key => $id){
						$where = array('id' => $id);
						$what = array('active' => "Y");
						if($array['name'] == "buys"){
							$table = $array['name'];
						} else {
							$table = $array['model'];
						}
						Element::Update($where, $what, $table);
					}
				} else if($_POST['action'] == 'deactivate'){
					
					foreach($_POST['id'] as $key => $id){
						$where = array('id' => $id);
						$what = array('active' => "N");
						if($array['name'] == "buys"){
							$table = $array['name'];
						} else {
							$table = $array['model'];
						}
						
						Element::Update($where, $what, $table);		
					}
				} else if($_POST['action'] == 'del'){
					foreach($_POST['id'] as $key => $id){
						$where = array('id' => $id);
						if($array['model'] == 'administrator'){ 
							$table = $array['name'];
						} else {
							$table = $array['model']; 
						}
						if($table != 'users' && $id != '7'){
							Element::Delete($where, $table);		
						} else if($table != 'pages' && $id != '1'){
							Element::Delete($where, $table);
						}
					}
				}
			}
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		$routes_from = explode('/', $_SERVER['HTTP_REFERER']);
		
		if($routes[1] == 'administrator'){
			if($routes[2] != $routes_from[4]){
				unset($_SESSION['user']['filter']);
				unset($_REQUEST['filter']);
			}
		} else {
			if($routes[1] != $routes_from[3]){
				unset($_SESSION['user']['filter']);
				unset($_REQUEST['filter']);
			}
		}
		
		$array['filter'] = NULL;
		if($_REQUEST['filter']['cancel'] == "сброс" || $_REQUEST['filter'] == "N"){
			unset($_SESSION['user']['filter']);
			unset($_REQUEST['filter']);
		} else {
			unset($_REQUEST['filter']['submit']);
		}
		
		if((($_GET['c'] == 0 || !$_GET['c'])) || ($array['model'] == "administrator" && $array['name'] != "content")) {
			unset($_SESSION['user']['filter']['cat']);
		}
		//пользовательская настройка по быстрому
		if(($_GET['c'] != 0 && !empty($_SESSION['user']['filter']['name'])) && $array['model'] != "administrator"){
			unset($_SESSION['user']['filter']['name']);
		}
		//
		if(isset($_GET['c']) && (!empty($_GET['c']))){
			$_REQUEST['filter']['cat'] = $_GET['c'];
			$_SESSION['user']['filter']['cat'] = $_REQUEST['c'];
			
		}
		
		
		if(isset($_REQUEST['name']) && (!empty($_REQUEST['name']))){
			$_REQUEST['filter']['name'] = $_REQUEST['name'];
			$_REQUEST['p'] = 1;
		}
		if((($_REQUEST['filter']) && !empty($_REQUEST['filter'])) || ($_SESSION['user']['filter'] && count($_SESSION['user']['filter']) > 0)){
			
			if(isset($_REQUEST['filter']) && !empty($_REQUEST['filter'])){
				if($_REQUEST['filter']['name'] && !empty($_REQUEST['filter']['name'])){
					
					$name = "%";
					$name.= $_REQUEST['filter']['name'];
					$name .= "%";
					$_REQUEST['filter']['name'] = $name;
					
				} else if(!empty($_SESSION['user']['filter']['name'])){
					$name = "%";
					$name.= Element::search($_SESSION['user']['filter']['name']);
					$name .= "%";
					$_REQUEST['filter']['name'] = $name;
					
				}
				$filter = $_REQUEST['filter'];
				$_SESSION['user']['filter'] = $_REQUEST['filter'];
			} else if(isset($_SESSION['user']['filter']) && !empty($_SESSION['user']['filter'])){
				
				$filter = $_SESSION['user']['filter'];
			}
			if($filter['cat'] && $filter['cat'] != ""){
				$filter_cats = array("active" => "Y", "parent" => $filter['cat']	);
				$cats_child = Element::SelectAll('cats', $filter_cats, null, null);
				
				if(count($cats_child) > 0){
					$filter['cat'] = array(0 => $filter['cat']);
					
					foreach($cats_child as $child_count => $child_cat){
						$filter['cat'][] = $child_cat['id'];
						
						$filter_cats = array("active" => "Y", "parent" => $child_cat['id']);
						$cats_child = Element::SelectAll('cats', $filter_cats, null, null);
						foreach($cats_child as $child_count2 => $child_cat2){
							$filter['cat'][] = $child_cat2['id'];
						}
					}
				}
			}
			
			
			$array['filter'] = $filter;
		}
		if($array['list_limit'] != '0'){
			$limit = $array['list_limit'];
			$array['pagination']['list_limit'] = $limit;
		} else {
			$limit = null;
			$array['pagination']['list_limit'] = $limit;
		}
		if(isset($_REQUEST['p'])){
			$page_num = $_REQUEST['p'];
			$array['pagination']['page_num'] = $_REQUEST['p'];
		} else {
			$page_num = 1;
			$array['pagination']['page_num'] = 1;
		}
		
		
		if($array['model'] == 'administrator'){
			$array['pages'] = Element::SelectAll('pages', $filter, $page, null);
			$array['cats'] = Element::SelectAll('pages', $filter, $page, null);
			if($array['name'] == 'pages'){
				$array['content']['pages'] = Element::SelectAll('pages', $filter, $page, $limit);
				if($limit != null){
					$max_pages = Element::SelectAll('pages', $filter, $page);
					$array['pagination']['max_pages'] = count($max_pages) / $limit;
				}
			}
			if($array['name'] == 'cats'){
				$array['content']['cats'] = Element::SelectAll('cats', $filter, $page, $limit);
				if($limit != null){
					$max_pages = Element::SelectAll('cats', $filter, $page);
					$array['pagination']['max_pages'] = count($max_pages) / $limit;
				}
			}
			if($array['name'] == 'content'){
				$array['content']['content'] = Element::SelectAll('content', $filter, $page, $limit);
				if($limit != null){
					$max_pages = Element::SelectAll('content', $filter, $page);
					$array['pagination']['max_pages'] = (count($max_pages)) / $limit;
					
				}
			}
			if($array['name'] == 'users'){
				$array['content']['users'] = Element::SelectAll('users', $filter, $page, $limit);
				if($limit != null){
					$max_pages = Element::SelectAll('users', $filter, $page);
					$array['pagination']['max_pages'] = count($max_pages) / $limit;
				}
			}
			if($array['name'] == 'buys'){
				$array['content']['buys'] = Element::SelectAll('buys', $filter, $page, $limit);
				if($limit != null){
					$max_pages = Element::SelectAll('buys', $filter, $page);
					$array['pagination']['max_pages'] = count($max_pages) / $limit;
				}
			}
		} else {
			if((isset($array['content_type'])) && ($array['content_type'] != "N")){
				if($array['template_type'] == 'personal'){
					$array['filter']['user'] = $_SESSION['user']['id'];
				}
				if($array['content_type'] == "list"){
					
					
					$array['content']['content'] = Element::GetList($array, $array['filter'], $limit);
						
					if($limit != null){
						$max_pages = Element::GetList($array, $array['filter']);
						$array['pagination']['max_pages'] = count($max_pages) / $limit;
						
					}
				} else if($array['content_type'] == "element" || $array['content_type'] == "detail"){
					$array['content']['content'] = Element::GetList($array, $array['filter'], $limit);
					if($limit != null){
						$max_pages = Element::GetList($array, $array['filter']);
						$array['pagination']['max_pages'] = count($max_pages) / $limit;
					}
				} else if($array['content_type'] == "cat"){
					$array['content']['content'] = Element::GetCatList($array, $array['filter'], $limit);
					if($limit != null){
						$max_pages = Element::GetCatList($array, $array['filter'], $limit);
						$array['pagination']['max_pages'] = count($max_pages) / $limit;
					}
				} else {
					$array['content']['content'] = Element::$array['content_type']($array, $array['filter'], $limit);
					if($limit != null){
						$max_pages = Element::$array['content_type']($array, $array['filter'], $limit);
						$array['pagination']['max_pages'] = count($max_pages) / $limit;
					}
				}
			}
		}
		
		
		
		
		
		
		return $array;
	}
	
	public function get_data_one($array)
	{
		
		$array['content'] = Element::GetOne($array['content']['alias']);
		//брать по id
		// Element::GetOne(NULL, array("id" => $id))
		
		$array['title'] = $array['content'][0]['title'];
		$array['metakeys'] = $array['content'][0]['metakeys'];
		$array['keywords'] = $array['content'][0]['keywords'];
		if(isset($array['content'][0]['parent_temp']) && !empty($array['content'][0]['parent_temp'])){
			$array['temp'] = $array['content'][0]['parent_temp'];
		}
		if(isset($array['content'][0]['child_temp']) && !empty($array['content'][0]['child_temp'])){
			$array['content_temp'] = $array['content'][0]['child_temp'];
		}
		if(isset($array['content'][0]['temp_folder']) && !empty($array['content'][0]['temp_folder'])){
			$array['temp_folder'] = $array['content'][0]['temp_folder'];
		}
		return $array;
	}
	
	
	public function create($array)
	{
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if($routes[1] == 'administrator'){
			$array['pages'] = DBConnect::init()->selectAll('pages', null);
			$array['cats'] = DBConnect::init()->selectAll('cats', null);
			
		}
		return $array;
	}
	
	public function settings($array)
	{
		return $array;
	}
	public function edit($array)
	{
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if($routes[1] == 'administrator'){
			$array['pages'] = DBConnect::init()->selectAll('pages', null);
			$array['cats'] = DBConnect::init()->selectAll('cats', null);
			
		}
		return $array;
	}
	
	public function login(){
		//реализовано ввиде модуля "modules/login/"
	}
	
	public function logout(){
		//реализовано ввиде модуля "modules/login/"
	}
	
	public function deactivate($array){
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if($routes[1] == 'administrator'){
			$page = $routes[2];
			$action = $routes[3];
			$id = $routes[4];
		} else {
			$page = $routes[1];
			$action = $routes[2];
			$id = $routes[3];
		}
		if($page == 'pages') {
			$table = $page;
		} else if($page == 'cats'){
			$table = $page;
		} else if($page == 'modules'){
			$table = $page;
		} else if($page == 'users'){
			$table = $page;
		} else if($page == 'buys'){
			$table = $page;
		} else {
			$table = 'content';
		}
		
		$where = array('id' => $id);
		$what = array('active' => "N");
		if(isset($id) && !empty($id) && $action == 'deactivate'){
			$mess = Element::Update($where, $what, $table);
		}
		return $mess;
	}
	public function activate($array){
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if($routes[1] == 'administrator'){
			$page = $routes[2];
			$action = $routes[3];
			$id = $routes[4];
		} else {
			$page = $routes[1];
			$action = $routes[2];
			$id = $routes[3];
		}
		if($page == 'pages') {
			$table = $page;
		} else if($page == 'cats'){
			$table = $page;
		} else if($page == 'modules'){
			$table = $page;
		} else if($page == 'users'){
			$table = $page;
		} else if($page == 'buys'){
			$table = $page;
		} else {
			$table = 'content';
		}
		
		$where = array('id' => $id);
		$what = array('active' => "Y");
		if(isset($id) && !empty($id) && $action == 'activate'){
			$mess = Element::Update($where, $what, $table);
		}
		return $mess;
	}
}