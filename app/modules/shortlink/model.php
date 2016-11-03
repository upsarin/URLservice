<?php

class ShortlinkModel
{

	// метод выборки данных
	public function get_data($array, $page)
	{
		$params = array("type" => "shortlink", "active" => "Y");
		$sort = array("sort", "asc");
		$array['FIELDS'] = DBConnect::init()->getFeilds($params, $sort);
		
		$array['content']['content'] = Element::SelectAll('shortlink', $filter=NULL, $page=NULL, $limit=NULL);
		return $array;
	}
	
	public function save_data($page, $array, $post) 
	{
		 
		if(isset($post['shortlink']['main']['orig_url'])){
			$post_array = explode("/", $post['shortlink']['main']['orig_url']);
			
			if($post_array[0] == "http:" || $post_array[0] == "https:"){
				$first_post_array = $post_array[0] ."//". $post_array[2] ."/";
				foreach($post_array as $key => $val){
					if($key > 2 && $val != ""){
						$end_post_array .= $val ."/";
					}
				}
			} else {
				$first_post_array = "http://". $post_array[0] ."/";
				foreach($post_array as $key => $val){
					if($key != 0 && $val != "")
					$end_post_array .= $val ."/";
				}
			}
			$first_part_link = $first_post_array;
			$second_part_link = md5($end_post_array. rand(0,9) ."foryou". rand(0,9) . date("YdmHis"));
			
			$post['shortlink']['main']['edit_url'] = "http://" . $_SERVER['HTTP_HOST'] ."/". substr($second_part_link, 0, 4);
			
			
			//проверка на существование сгенерированной ссылки
			$check_url = Element::SelectAll('shortlink', $filter=array("edit_url" => $post['shortlink']['main']['edit_url']), $page=NULL, $limit=NULL);
			
			while(count($check_url) > 0){
				$post['shortlink']['main']['edit_url'] .= substr($second_part_link, rand(11, 12), rand(12, 13));
				$check_url = Element::SelectAll('shortlink', $filter=array("edit_url" => $post['shortlink']['main']['edit_url']), $page=NULL, $limit=NULL);
			}
			
			$post['shortlink']['main']['orig_url'] = $first_part_link . $end_post_array;
		}
		
		
		$query = Element::SaveElementsWithImages(array($post['shortlink']));
		if($query['confirm'] == true){
			if(!empty($array['confirm_phrase'] && $_REQUEST['ajax'] != "Y")){
				$data['mess'] = $array['confirm_phrase'];
			} else if($_REQUEST['ajax'] == "Y"){
				$data['mess'] = json_encode(array("id" => $query['id'], "orig_url" => $first_post_array . $end_post_array, "edit_url" => $post['shortlink']['main']['edit_url']));
			} else {
				$data['mess'] = "Успешное сохранение.";
			}
			
		} else {
			if(!empty($array['error_phrase'])){
				$data['mess'] = $array['error_phrase'];
			} else {
				$data['mess'] = "Произошла ошибка при сохранении.";
			}
		}
		return $data; 
		
	}
	
}