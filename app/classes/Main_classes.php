<?
/**
 * Класс Element, для работы с БД и другими методами
 */
class Element
{
	static function search($string) {
		$rus_alphabet = array(
			'%'
		);
    
		// Английская транслитерация
		$rus_alphabet_translit = array(
			''
		);
    
		return str_replace($rus_alphabet, $rus_alphabet_translit, $string);
	}
	static function Translit_rus($string) {
		$rus_alphabet = array(
			'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й',
			'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф',
			'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
			'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й',
			'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф',
			'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', ' ', "/", '"', ",", "*", "№", "`", ".", "(", ")", "%"
		);
    
		// Английская транслитерация
		$rus_alphabet_translit = array(
			'A', 'B', 'V', 'G', 'D', 'E', 'IO', 'ZH', 'Z', 'I', 'I',
			'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F',
			'H', 'C', 'CH', 'SH', 'SH', '', 'Y', '', 'E', 'IU', 'Ya',
			'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'i',
			'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f',
			'h', 'c', 'ch', 'sh', 'sh', '', 'y', '', 'e', 'iu', 'ya', '-', "-", "-", "-", "-", "-", "", "-", "-", "-", "p"
		);
    
		return str_replace($rus_alphabet, $rus_alphabet_translit, $string);
	}
	static function Translit_eng($string) {
		$rus_alphabet = array(
			'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й',
			'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф',
			'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
			'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й',
			'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф',
			'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', ' '
		);
    
		// Английская транслитерация
		$rus_alphabet_translit = array(
			'A', 'B', 'V', 'G', 'D', 'E', 'IO', 'ZH', 'Z', 'I', 'I',
			'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F',
			'H', 'C', 'CH', 'SH', 'SH', '`', 'Y', '`', 'E', 'IU', 'Ya',
			'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'i',
			'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f',
			'h', 'c', 'ch', 'sh', 'sh', '', 'y', '', 'e', 'iu', 'ya', '-' 
		);
    
		return str_replace($rus_alphabet_translit, $rus_alphabet, $string);
	}
	
	static function SelectAll($table=null, $filter=null, $page=null, $limit=null, $params = null, $fixed=null){
		if($limit != null){
			if(isset($_REQUEST['p'])){
				$page_num = $_REQUEST['p'];
			} else {
				$page_num = 1;
			}
			
			if($page_num == 1){
				$limits['limit_from'] = ($page_num - 1) * $limit;
				$limits['limit_to'] = $limit;
			} else {
				$limits['limit_from'] = ($page_num - 1) * $limit;
				$limits['limit_to'] = $limit;
			}
		} else {
			$limits = null;
		}
		$result = DBConnect::init()->selectAll($table, $filter, $limits, $params, $fixed);
		return $result;
	}
	static function Update($where, $what, $table){
		$result = DBConnect::init()->updateElements($where, $what, $table);
		return $result;
	}
	static function Delete($where, $table){
		$result = DBConnect::init()->Delete($where, $table);
		return $result;
	}
	static function SaveElements($array, $table=null){
		$result = DBConnect::init()->saveElements($array, $table);
		return $result;
	}
	static function SaveElementsWithImages($array){
		$result = DBConnect::init()->saveElementsWithImages($array);
		return $result;
	}
	static function SaveField($field){
		$result = DBConnect::init()->saveField($field);
		return $result;
	}
	static function GetList($array, $filter=null, $limit=null){
		if($limit != null){
			if(isset($_REQUEST['p'])){
				$page_num = $_REQUEST['p'];
			} else {
				$page_num = 1;
			}
			
			if($page_num == 1){
				$limits['limit_from'] = ($page_num - 1) * $limit;
				$limits['limit_to'] = $limit;
			} else {
				$limits['limit_from'] = ($page_num - 1) * $limit;
				$limits['limit_to'] = $limit;
			}
		} else {
			$limits = null;
		}
		$filter['active'] = "Y";
		
		$result = DBConnect::init()->selectContent($array['id'], $filter, NULL, $limits);
		foreach($result as $key => $val){
			$params = array('element_id' => $val['id']);
			$table = 'field_value';
			$fields = DBConnect::init()->getFeildsValues($params, null, $table);
			foreach($fields as $field => $value){
				$result[$key][$value['code']] = $value['value'];
			}
			
			
		}
		
		return $result;
	}
	
	static function GetCatList($array, $filter, $limit){
		$filter = array("active" => "Y");
		$result = DBConnect::init()->selectContent($array['id'], $filter, NULL);
		return $result;
	}
	
	static function GetOne($alias = NULL, $filter = NULL, $fields = NULL, $table = NULL){
		if($filter == NULL){
			$filter = array("active" => "Y");
		}
		$result = DBConnect::init()->selectOne($alias, $filter, $fields, $table);
		foreach($result as $key => $val){
			$params = array('element_id' => $val['id']);
			$table = 'field_value';
			$fields = DBConnect::init()->getFeildsValues($params, null, $table);
			foreach($fields as $field => $value){
				$result[$key][$value['code']] = $value['value'];
			}
			
			
		}
		//брать по id
		// DBConnect::init()->selectOne(NULL, $filter, NULL)
		return $result;
	}
	static function GetFeildsValues($params=null, $sort=null, $table=null){
		$result = DBConnect::init()->getFeildsValues($params, $sort, $table);
		return $result;
	}
	static function GetByID($id, $return=null, $table=null){
		if(is_numeric($id)){
			$result = DBConnect::init()->selectByID($id, $table);
		} else { 
			$result = DBConnect::init()->selectByName($id, $table);
		}
		if(isset($result[0][$return]) && $return != '*'){
			return $result[0][$return];
		} else {
			return $result[0];
		}
	}
	
	
	static function Page($params = NULL, $id = NULL, $filter = NULL){

		return DBConnect::init()->selectPage($params, $id, $filter);
	}
	static function GetField($name){
		
	}
	
	static function countElements($page_id, $table, $filter){

		return DBConnect::init()->countElements($page_id, $table, $filter);
	}

	static function inputShow($val){
		if($val['required'] == "Y"){
			$required = "required='required'";
		} else {
			$required = "";
		}
		$default_value = (!empty($val["default_value"]) && $val["default_value"] != "") ? $val["default_value"] : "";
		if(isset($val['value']) && !empty($val['value'])){
			$field_val = $val['value'];
		}
		if($val['input_type'] == 'text' && $val['multi'] == 'N'){
			if(isset($field_val) && !empty($field_val)){
				$default_value = $field_val;
			}
			
			return "<input class='form-control' id='". $val["code"] ."' type='". $val["input_type"] ."' name='". $val["code"] ."' value='". $default_value ."' ". $required ." autocomplete='off'/>";
		} else if($val['input_type'] == 'hidden'){
			if(isset($field_val) && !empty($field_val)){
				$default_value = $field_val;
			}
			return '<input class="form-control" id="'. $val["code"] .'" type="'. $val["input_type"] .'" name="'. $val["code"] .'" value="'. $default_value .'" '. $required .'/>';
		} else if($val['input_type'] == 'checkbox'){
			$options = explode(',', $default_value);
			$options_name = explode(',', $val['default_names']);
			
			$data = "";
			foreach($options as $option => $value){
				if(isset($options_name[$option])){
					$data .= '<label for="'. $val["code"] .'-'. $option .'" style="color: black">'. $options_name[$option] .'</label>';
				}
				
				if($field_val == $value){
					$check = "checked='checked'";
				} else {
					if($val['code'] == "main[active]"){
						$check = "checked='checked'";
					} else {
						$check = "";
					}
					
				}
				
				$data .= '<input class="form-control" id="'. $val["code"] .'-'. $option .'" type="'. $val["input_type"] .'" name="'. $val["code"] .'" value="'. $value .'" '. $check .' '. $required .'/>';
			}
			return $data;
		} else if($val['input_type'] == 'select'){
			$data = '';
			if(!empty($val['default_type']) && !empty($val['default_type_value'])){
				if($val['default_type'] == 'list'){
					$table = explode('=', $val['default_type_value']);
					if($table[1] == '*'){
						
						$result = DBConnect::init()->selectAll($table[0], null);
					} else {
						$filter = explode(':', $table[1]);
						$filter = array($filter[0] => $filter[1]);
						$result = DBConnect::init()->selectAll($table[0], $filter);
					}
					$routes = explode('/', $_SERVER['REQUEST_URI']);
					foreach($result as $key => $some){
						if($routes[4] != $some['id']){
							$options[] = $some['id'];
							if($table[0] == 'users'){
								$options_name[] = $some['login'];
							} else {
								$options_name[] = $some['name'];
							}
							
						}
					}
					
				}
			} else {
				$options = explode(',', $default_value);
				$options_name = explode(',', $val['default_names']);
			}
			
			if($val['code'] == "main[cat]"){
				echo "
				<script>
				$(document).ready(function(){
					$('.input-search-name').keyup(function(){
						var obj = $('.input-search-name').val();
						obj = obj.toLowerCase();
						var count = $('.category').length;
						for(var j = 0; j < count;){
							$('.category')[j].removeAttribute('selected');
							j = j+1;
						}
						for(var j = 0; j < count;){
							var our_string = $('.category')[j].innerHTML;
							our_string = our_string.toLowerCase();
							if(our_string.indexOf(obj) + 1) {
								var elId = $('.category')[j].id;
								console.log(elId);
								$('#' + elId).attr('selected', 'selected');
								console.log($('#' + elId))
							}
							
							j = j+1;
						}
					})
				});
				</script>
				";
				$data .='
					<input class="form-control" type="text" id="'. $table[0] .'" class="input-search-name" value="" placeholder = "Начните вводить"/>
				';
			}
			if($val['code'] == "main[cat]"){
				$data .= '
				<select size="1" id="'. $val["code"] .'" name="'. $val['code'] .'">
				';
			} else {
				$data .= '
				<select id="'. $val["code"] .'" name="'. $val['code'] .'">
				';
			}
			if($val['code'] == "main[cat]"){
				
				if((isset($_SESSION['user']['last_cat']) && !empty($_SESSION['user']['last_cat'])) && (isset($_GET['model']) && !empty($_GET['model']))){
					$field_val = $_SESSION['user']['last_cat'];
				}
				foreach($options as $option => $value){
					$parent = Element::GetByID($value, 'parent', 'cats');
					if($field_val == $value){
						$check = "selected='selected'";
					} else {
						$check = "";
					}
					
					$options_array[$option]['id'] = $options[$option];
					$options_array[$option]['name'] = $options_name[$option];
					$options_array[$option]['check'] = $check;
					$options_array[$option]['parent'] = $parent;
				}
			}
					
			foreach($options as $option => $value){
				
				if($val['code'] == "main[cat]"){
					if($options_array[$option]["parent"] == 0){
						$data .= '
							<option class="category" id="category'. $option .'" value="'. $options_array[$option]["id"] .'" '. $options_array[$option]["check"] .' style="background:grey">'. $options_array[$option]['name'] .'</option>
						';
						foreach($options_array as $key2 => $val2){
							if($options_array[$option]["id"] == $val2['parent']){
								$data .= '
									<option class="category" id="category'. $key2 .'" value="'. $val2["id"] .'" '. $val2["check"] .' style="background:rgba(134, 129, 129, 0.55)">...'. $val2['name'] .'</option>
								';
								foreach($options_array as $key3 => $val3){
									if($val2["id"] == $val3['parent']){
										$data .= '
											<option class="category" id="category'. $key3 .'" value="'. $val3["id"] .'" '. $val3["check"] .' style="background:rgba(134, 129, 129, 0.2)">... ...'. $val3['name'] .'</option>
										';
										foreach($options_array as $key4 => $val4){
											if($val3["id"] == $val4['parent']){
												$data .= '
													<option class="category" id="category'. $key4 .'" value="'. $val4["id"] .'" '. $val4["check"] .' style="background:rgba(134, 129, 129, 0.2)">... ... ...'. $val4['name'] .'</option>
												'; 
											}
										}
									}
								}
							}
						}
					}
				} else {
					if($field_val == $value){
						$check = "selected='selected'";
					} else {
						$check = "";
					}
					$data .= '
						<option value="'. $value .'" '. $check .' style="background:grey">'. $options_name[$option] .'</option>
					';
				}
			}
			$data .= '</select>';
			if(isset($table[0])){
				// $data .='
					// <input type="text" id="'. $table[0] .'" class="input-search-id" value="" placeholder = "введите id"/>
				// ';
			}
			return $data;
			
		} else if($val['input_type'] == 'textarea'){
			$text = (isset($field_val) && !empty($field_val)) ? $field_val : $default_value;
			if($val['code'] == "main[desc]" || $val['code'] == "main[preview_desc]"){
				return '<textarea class="desc" id="'. $val["code"] .'" name="'. $val['code'] .'" rows="5" cols="45" '. $required .'>'. $text .'</textarea>'; 
			} else {
				return '<textarea id="'. $val["code"] .'" name="'. $val['code'] .'" rows="5" cols="45" '. $required .'>'. $text .'</textarea>'; 
			}
			
		} else if($val['input_type'] == 'file'){
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			
			if($routes[3] == "edit" && is_numeric($routes[4])){ 
				$filter = array("content_id" => $routes[4]);
				$images = Element::SelectAll('files', $filter, null, null);
				?><ul id="edit-list"><?
				foreach($images as $im_key => $image){
			?>
					<li>
						<a id="<?=$image['id']?>" href=""><img src="/<?=$image['path']?>" /></a>
					</li>
			<? 
				} ?>
				</ul>
				
			<? }
			
			return '<input class="form-control" style="color:black" id="files" type="'. $val["input_type"] .'" name="file[]" multiple  '. $required .'/> <br />
					<ul id="list"></ul>
					<script>
	$(document).ready(function(){
		function showFile(e) {
			document.getElementById("list").innerHTML = "";
			var files = e.target.files;
			console.log(files);
			for (var i = 0, f; f = files[i]; i++) {
			  if (!f.type.match("image.*")) continue;
			  var fr = new FileReader();
			  fr.onload = (function(theFile) {
				return function(e) {
				  var li = document.createElement("li");
				  console.log(e.target)
				  li.innerHTML = "<img src=\'" + e.target.result + "\' />";
				  document.getElementById("list").insertBefore(li, null);
				};
			  })(f);
		 
			  fr.readAsDataURL(f);
			}
		}
		 
		document.getElementById("files").addEventListener("change", showFile, false);
	});
	</script>
					';
		} else if($val['input_type'] == 'HTML'){
			return 'в разработке';
		} else if($val['input_type'] == 'date'){
			if(isset($field_val) && !empty($field_val)){
				$default_value = $field_val;
			}
			return '<input class="form-control" id="'. $val["code"] .'" type="'. $val["input_type"] .'" name="'. $val["code"] .'" value="'. $default_value .'"  '. $required .'/>';
		}
	}
	static function saveFile($id){
		
		$user_dir = "uploads/user_files/". $_SESSION['user']['id'];
				if(is_dir($user_dir)){
					$user_dir = $user_dir;
					
				} else {
					@mkdir($user_dir, "0777");
					chmod($user_dir, 0777); 
				}
				
				$user_images = "uploads/user_files/". $_SESSION['user']['id'] ."/images";
				if(is_dir($user_images)){
					$user_docs = $user_docs;
				} else {
					@mkdir($user_images, "0777");	
					chmod($user_images, 0777); 
				}
				
				$user_docs = "uploads/user_files/". $_SESSION['user']['id'] ."/docs";
				if(is_dir($user_docs)){
					$user_docs = $user_docs;
				} else {
					@mkdir($user_docs, "0777");	
					chmod($user_docs, 0777);  
				}
				
				
				foreach($_FILES['file']['name'] as $key => $val){
					
					
					$file_name_base = $_FILES['file']['tmp_name'][$key];
					
					$type = explode('/', $_FILES['file']['type'][$key]);
					if($type[0] == 'image'){
						$file_type = 'images';
					} else {
						$file_type = 'docs';
					}
					$file_name = md5($_FILES['file']['name'][$key] ."ser". date('dmYHis') ."ver". $_SESSION['user']['id']);
					$format = explode('/', $_FILES['file']['type'][$key]);
					
					
					copy($file_name_base, "uploads/user_files/". $_SESSION['user']['id'] ."/". $file_type ."/". basename($file_name) .".". $format[1]);
					
					$files = array(
						"name" => $file_name .".". $format[1],
						"type" => $file_type,
						"user_id" => $_SESSION['user']['id'],
						"chain_type" => "",
						"chain_id" => "",
						"path" => "uploads/user_files/". $_SESSION['user']['id'] ."/". $file_type ."/". basename($file_name) .".". $format[1],
						"title" => "",
						"server_name" => $_SERVER['HTTP_HOST'],
						"hits" => 0,
						"content_id" => $id
					);
					
					Element::SaveFileData(array($files));
					unset($_FILES);
					
				}

	}
	static function SaveFileData($array){
		$result = DBConnect::init()->saveFileData($array);
		return $result;
	}
}
class Ajax
{
	static function postData(){
		
	}
	static function returnSuccess(){
		
	}
}

class Time
{
	
	/*
	День 	--- 	---
%a 	Сокращенное название дня недели 	От Sun до Sat
%A 	Полное название дня недели 	От Sunday до Saturday
%d 	Двухзначное представление дня месяца (с ведущими нулями) 	От 01 до 31
%e 	День месяца, с ведущим пробелом, если он состоит из одной цифры. На Windows реализован не так, как описано. Подробнее смотрите ниже. 	От 1 до 31
%j 	Порядковый номер в году, 3 цифры с ведущими нулями 	От 001 до 366
%u 	Порядковый номер дня недели согласно стандарту ISO-8601 	От 1 (понедельник) до 7 (воскресенье)
%w 	Порядковый номер дня недели 	От 0 (воскресенье) до 6 (суббота)
Неделя 	--- 	---
%U 	Порядковый номер недели в указанном году, начиная с первого воскресенья в качестве первой недели 	13 (для полной 13-й недели года)
%V 	Порядковый номер недели в указанном году в соответствии со стандартом ISO-8601:1988, счет начинается с той недели, которая содержит минимум 4 дня, неделя начинается с понедельника 	От 01 до 53 (где 53 указывает на перекрывающуюся неделю)
%W 	Порядковый номер недели в указанном году, начиная с первого понедельника в качестве первой недели 	46 (для 46-й недели года, начинающейся с понедельника)
Месяц 	--- 	---
%b 	Аббревиатура названия месяца, в соответствии с настройками локали 	От Jan до Dec
%B 	Полное название месяца, в соответствии с настройками локали 	От January до December
%h 	Аббревиатура названия месяца, в соответствии с настройками локали (псевдоним %b) 	От Jan до Dec
%m 	Двухзначный порядковый номер месяца 	От 01 (январь) до 12 (декабрь)
Год 	--- 	---
%C 	Двухзначный порядковый номер столетия (год, деленный на 100, усеченный до целого) 	19 для 20-го века
%g 	Двухзначный номер года в соответствии со стандартом ISO-8601:1988 (см. %V) 	Пример: 09 для недели 6 января 2009
%G 	Полная четырехзначная версия %g 	Пример: 2008 для недели 3 января 2009
%y 	Двухзначный порядковый номер года 	Пример: 09 для 2009, 79 для 1979
%Y 	Четырехзначный номер года 	Пример: 2038
Время 	--- 	---
%H 	Двухзначный номер часа в 24-часовом формате 	От 00 до 23
%k 	Двухзначное представление часа в 24-часовом формате, с пробелом перед одиночной цифрой 	От 0 до 23
%I 	Двухзначный номер часа в 12-часовом формате 	От 01 до 12
%l (строчная 'L') 	Час в 12-часовом формате, с пробелом перед одиночной цифрой 	От 1 до 12
%M 	Двухзначный номер минуты 	От 00 до 59
%p 	'AM' или 'PM' в верхнем регистре, в зависимости от указанного времени 	Пример: AM для 00:31, PM для 22:23
%P 	'am' или 'pm' в зависимости от указанного времени 	Пример: am для 00:31, pm для 22:23
%r 	Тоже что и "%I:%M:%S %p" 	Пример: 09:34:17 PM для 21:34:17
%R 	Тоже что и "%H:%M" 	Пример: 00:35 для 12:35 AM, 16:44 для 4:44 PM
%S 	Двухзначный номер секунды 	От 00 до 59
%T 	Тоже что и "%H:%M:%S" 	Пример: 21:34:17 для 09:34:17 PM
%X 	Предпочитаемое отображение времени в зависимости от локали, без даты 	Example: 03:59:16 or 15:59:16
%z 	Смещение временной зоны относительно UTC. Не реализовано в Windows, подробности см. ниже. 	Пример: -0500 для US Eastern Time
%Z 	Аббревиатура временной зоны. Не реализовано в Windows, подробности см. ниже. 	Пример: EST для Eastern Time
Метки даты и времени 	--- 	---
%c 	Предпочитаемое отображение даты и времени, в зависимости от текущей локали 	Пример: Tue Feb 5 00:45:10 2009 для 5 февраля 2009 00:45:10
%D 	Тоже что и "%m/%d/%y" 	Пример: 02/05/09 для 5 февраля 2009
%F 	Тоже что и "%Y-%m-%d" (обычно используется в метках времени баз данных) 	Пример: 2009-02-05 для 5 февраля 2009
%s 	Метка времени Эпохи Unix (тоже что и функция time()) 	Пример: 305815200 для 10 сентября 1979 08:40:00
%x 	Предпочитаемое отображение даты, без времени 	Пример: 02/05/09 для 5 февраля 2009
Различное 	--- 	---
%n 	Символ перевода строки ("\n") 	---
%t 	Символ табуляции ("\t") 	---
%% 	Символ процента ("%") 	---

Максимальной длиной данного параметра является 1023 символа.
Внимание

В отличие от ISO-9899:1999, в Sun Solaris воскресенью присвается номер 1. Как результат, %u может работать не так, как описано в этом руководстве.
Внимание

Только для Windows:

Модификатор %e не поддерживается в реализации этой функции в Windows. Для использования этого значения необходимо вместо него использовать модификатор %#d. Пример ниже иллюстрирует кроссплатформенно совместимую функцию.

Модификаторы %z и %Z возвращают название временной зоны вместо смещения или аббревиатуры.
Внимание 

Только для Mac OS X: модификатор %P не поддерживается в реализации этой функции в Mac OS X.

	*/
	static function prepare($cur_format, $format){
		return date($format, strtotime($cur_format));
	}
}
function Redirect($page_name=null, $phrase=null, $referer=null){
	if($referer != null){
		echo '<script>window.location = "'. $referer .'"</script>';
	} else {
		echo '<script>window.location = "/'. $page_name .'/'. $phrase .'"</script>';
	}
	//редиректит только по имени страницы! НЕ ПО ID!!!
				
}
function History($back_by){
				echo '<script>window.history.go('. $back_by .')</script>';
}
function Refresh(){
				echo '<script>window.location = "http://'. $_SERVER['HTTP_REQUEST'] .'"</script>';
}
?>