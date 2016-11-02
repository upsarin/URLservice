<?php

/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/
class Router
{

	static function start($page_name = NULL)
	{
		if($page_name != NULL){
			$_SERVER['REQUEST_URI'] = '/'. $page_name .'/';
		}
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		
		if($routes[1] == 'Ajax'){
					if ( !empty($routes[2]) ){	
						$page = $routes[2];
					} else {
						$page = "main";
					}
					$page_info = Controller()->showPage($page);
					
					if($page_info['name'] == $page){
						
						 if(isset($routes[3]) && !empty($routes[3]) && (substr($routes[3], 0, 1) != "?")){
							
								
							if($routes[3] == "detail"){ 
								$page_info['action'] = $routes[3];
								$page_info['content_type'] = "detail";
								if(isset($routes[4]) && !empty($routes[4])){
									$page_info['content']['alias'] = $routes[4];
								}
							} else if($routes[2] == "personal" || $routes[2] == "administrator"){
								$page = $routes[3];
								
								
								$page_info = Controller()->showPage($page);
								$page_info['action'] = "index"; 
								if(isset($routes[4]) && !empty($routes[4]) && (substr($routes[4], 0, 1) != "?")){
									
									if($routes[4] == "detail"){
										$page_info['action'] = $routes[4];
										$page_info['content_type'] = "detail";
										if(isset($routes[5]) && !empty($routes[5])){
											$page_info['content']['alias'] = $routes[5];
										} 
									} else {
										$page_info['action'] = $routes[4];
									}
								}
							} else {
								$page_info['action'] = $routes[3];
							}
								
							
						 } else {
							$page_info['action'] = "index";
						 }

						
						$obj->$page_info['action']($page_info);
						
					} else { 
						Router::ErrorPage404();
					}			
		} else {
		// получаем имя контроллера
			if ( !empty($routes[1]) ){	
				$page = $routes[1];
			} else {
				$page = "main";
			}
				
					$obj = new Controller();
					$page_info = $obj->showPage($page);
					$short_link = Element::SelectAll('shortlink', $filter=array("edit_url" => "http://". $_SERVER['HTTP_HOST'] ."/". $page));
					if($page_info['name'] == $page){
						
						 if(isset($routes[2]) && !empty($routes[2]) && (substr($routes[2], 0, 1) != "?")){
							
								
							if($routes[2] == "detail"){ 
								$page_info['action'] = $routes[2];
								$page_info['content_type'] = "detail";
								if(isset($routes[3]) && !empty($routes[3])){
									$page_info['content']['alias'] = $routes[3];
								}
							} else if($routes[1] == "personal" || $routes[1] == "administrator"){
								$page = $routes[2];
								
								$obj = new Controller();
								$page_info = $obj->showPage($page);
								$page_info['action'] = "index"; 
								if(isset($routes[3]) && !empty($routes[3]) && (substr($routes[3], 0, 1) != "?")){
									
									if($routes[3] == "detail"){
										$page_info['action'] = $routes[3];
										$page_info['content_type'] = "detail";
										if(isset($routes[4]) && !empty($routes[4])){
											$page_info['content']['alias'] = $routes[4];
										} 
									} else {
										$page_info['action'] = $routes[3];
									}
								}
							} else {
								$page_info['action'] = $routes[2];
							}
								
							
						 } else {
							$page_info['action'] = "index";
						 }

						
						$obj->$page_info['action']($page_info);
						
					} else if(count($short_link) > 0){
						header("HTTP/1.1 301 Moved Permanently"); 
						header("Location: ". $short_link[0]['orig_url']);
					} else { 
						Router::ErrorPage404();
					}
				
		// получаем имя экшена
		}
	}

	static function ErrorPage404()
	{
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		include ($host.'404');
    }
    
}
