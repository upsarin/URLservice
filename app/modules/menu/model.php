<?php

class ModModel
{

	// метод выборки данных
	public function get_data($array)
	{
		
		
		// if(isset($array['chain_modules']) && (count($array['chain_modules']) > 0)){
			// foreach($array['chain_modules'] as $key => $val){
				// $params = array("menu_active" => "Y", "menu_type" => $val['pos']);
				// $array[] = DBConnect::init()->getMemu($array['type'], $params); 
			// }
		// } else {
			
			$params = array("menu_active" => "Y", "menu_type" => $array['pos'], "active" => "Y");
			$array = DBConnect::init()->getMemu($array['type'], $params);
		// }
		
		return $array;
	}

}